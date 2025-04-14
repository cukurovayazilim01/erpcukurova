<?php

namespace App\Http\Controllers;

use App\Models\Sosyalmedya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class FacebookApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function redirect()
    {
        return Socialite::driver('facebook')
            ->scopes([
                'public_profile',
                'pages_show_list',
                'pages_read_engagement',
                'instagram_basic',
                'pages_manage_metadata',
                'instagram_content_publish'
            ])
            ->redirect();
    }

    public function callback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        // Kullanıcı Access Token
        $accessToken = $user->token;

        // Adım 1: Kullanıcının sayfalarını çek
        $pages = Http::get("https://graph.facebook.com/v22.0/me/accounts", [
            'access_token' => $accessToken
        ])->json();

        if (!empty($pages['data'])) {
            $pageId = $pages['data'][0]['id'];
            $pageAccessToken = $pages['data'][0]['access_token'];

            // Adım 2: Sayfaya bağlı Instagram hesabını çek
            $igAccount = Http::get("https://graph.facebook.com/v22.0/{$pageId}", [
                'fields' => 'instagram_business_account',
                'access_token' => $pageAccessToken
            ])->json();

            // ✅ Session'a kaydet
            if (isset($igAccount['instagram_business_account']['id'])) {
                session([
                    'access_token' => $accessToken,
                    'instagram_account_id' => $igAccount['instagram_business_account']['id']
                ]);
            }

            return redirect()->route('sosyalmedya.index')->with('success', 'Instagram hesabı başarıyla bağlandı.');
        }

        return redirect()->route('sosyalmedya.index')->with('error', 'Kullanıcının yönetici olduğu bir sayfa bulunamadı.');
    }


    public function debugFacebookUrl($url)
    {
        $accessToken = env('FACEBOOK_DEBUG_TOKEN');

        $response = Http::get('https://graph.facebook.com/', [
            'id' => $url,
            'scrape' => 'true',
            'access_token' => $accessToken,
        ]);

        return $response->json();
    }

   public function postToInstagram(Request $request)
{
    $accessToken = session('access_token');
    $instagramAccountId = session('instagram_account_id');

    if (!$accessToken || !$instagramAccountId) {
        return back()->with('error', 'Instagram oturumu eksik.');
    }

    // Kayıt işlemleri
    $sosyalmedya = new Sosyalmedya();
    $sosyalmedya->islem_yapan = Auth::id();
    $sosyalmedya->islem_tarihi = now();
    $sosyalmedya->gonderi_tipi = $request->has('isReels') ? 'REELS' : ($request->has('isCarousel') ? 'CAROUSEL' : 'GÖRSEL');
    $sosyalmedya->gonderi_adi = $request->gonderi_adi;
    $sosyalmedya->text = $request->text;
    $sosyalmedya->platforms = implode(',', $request->service);

    $mediaUrls = [];
    if ($request->hasFile('resim')) {
        foreach ($request->file('resim') as $index => $dosya) {
            $uzanti = strtolower($dosya->getClientOriginalExtension());
            $gonderiAdi = preg_replace('/[^A-Za-z0-9\-_.]/', '', str_replace(' ', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $sosyalmedya->gonderi_adi)));
            $dosyaAdi = $gonderiAdi . '-' . time() . '-' . $index . '.' . $uzanti;
            $dosya->move(public_path('/sosyalmedyalarimiz/resim'), $dosyaAdi);
            $mediaUrls[] = url('/sosyalmedyalarimiz/resim/' . $dosyaAdi);
        }
    }

    // $sosyalmedya->video = json_encode($mediaUrls);
    $sosyalmedya->save();

    $creationIds = [];

    // Her bir medya dosyası için creation_id oluştur
    foreach ($mediaUrls as $mediaUrl) {
        $ext = pathinfo($mediaUrl, PATHINFO_EXTENSION);
        $isVideo = in_array(strtolower($ext), ['mp4', 'mov']);

        // Reels için tek video olmalı
        if ($request->has('isReels')) {
            $mediaType = 'REELS';
            $params = [
                'media_type' => 'REELS',
                'video_url' => $mediaUrl,
                'caption' => $request->text,
                'access_token' => $accessToken,
            ];
        }
        // Carousel için image/video
        elseif ($request->has('isCarousel')) {
            $params = [
                $isVideo ? 'video_url' : 'image_url' => $mediaUrl,
                'is_carousel_item' => true,
                'access_token' => $accessToken,
            ];
        }
        // Normal gönderi
        else {
            $params = [
                $isVideo ? 'video_url' : 'image_url' => $mediaUrl,
                'caption' => $request->text,
                'access_token' => $accessToken,
            ];
        }

        $mediaResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", $params);
        $mediaData = $mediaResponse->json();

        if (!isset($mediaData['id'])) {
            return back()->with('error', 'Medya oluşturulamadı: ' . json_encode($mediaData));
        }

        $creationIds[] = $mediaData['id'];
    }

    // Her bir medya nesnesi hazır olana kadar bekle
    foreach ($creationIds as $creationId) {
    $ready = false;

    for ($i = 0; $i < 10; $i++) { // 10 deneme yap (30 saniye toplam)
        sleep(3);

        $check = Http::get("https://graph.facebook.com/v22.0/{$creationId}?fields=status_code&access_token={$accessToken}");
        $status = $check->json();

        if (isset($status['status_code']) && $status['status_code'] === 'FINISHED') {
            $ready = true;
            break;
        }

        // Eğer API rate limit veya geçici hata dönerse, kısa bir süre beklemeye devam et
        if (isset($status['error'])) {
            \Log::warning('Instagram API bekleme hatası', $status);
            continue;
        }
    }

    if (!$ready) {
        return back()->with('error', 'Medya hazır hale gelmedi: ' . $creationId);
    }
}


    // Carousel ise önce container oluşturulmalı
    if ($request->has('isCarousel')) {
        $carouselCreate = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", [
            'media_type' => 'CAROUSEL',
            'children' => implode(',', $creationIds),
            'caption' => $request->text,
            'access_token' => $accessToken,
        ]);

        $carouselData = $carouselCreate->json();

        if (!isset($carouselData['id'])) {
            return back()->with('error', 'Carousel oluşturulamadı: ' . json_encode($carouselData));
        }

        $creationIds = [$carouselData['id']];
    }

    // Yayınla
    foreach ($creationIds as $creationId) {
        $publish = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media_publish", [
            'creation_id' => $creationId,
            'access_token' => $accessToken,
        ]);

        $publishData = $publish->json();

        if (!isset($publishData['id'])) {
            return back()->with('error', 'Yayınlama başarısız: ' . json_encode($publishData));
        }
    }

    return back()->with('success', 'Instagram gönderisi başarıyla paylaşıldı!');
}
 public function getInstagramBusinessData(Request $request)
    {
        // Session'dan verileri al
        $accessToken = session('access_token');
        $instagramAccountId = session('instagram_account_id');

        if (!$accessToken || !$instagramAccountId) {
            return response()->json([
                'error' => 'Instagram hesabı bağlı değil ya da oturum süresi dolmuş.'
            ], 401);
        }

        // Instagram kullanıcı adını elle tanımla veya veritabanından çek
        $username = $request->input('user_name'); // burayı dinamik yapabilirsin

        if (!$username) {
            return response()->json([
                'error' => 'Instagram kullanıcı adı (user_name) belirtilmedi.'
            ], 400);
        }

        // Instagram verilerini çek
        $response = Http::get("https://graph.facebook.com/v22.0/{$instagramAccountId}", [
            'fields' => "business_discovery.username({$username}){followers_count,media_count,media{comments_count,like_count}}",
            'access_token' => $accessToken,
        ]);

        // API yanıtını kontrol et
        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'followers' => $data['business_discovery']['followers_count'] ?? 0,
                'media_count' => $data['business_discovery']['media_count'] ?? 0,
                'media' => $data['business_discovery']['media']['data'] ?? []
            ]);
        }

        // Hatalı durumlarda API yanıtını döndür
        return response()->json([
            'error' => 'Instagram verileri alınamadı.',
            'details' => $response->json()
        ], $response->status());
    }

    public function instagram()
    {
        return view('admin.contents.smhesaplarilist.instagram.instagram');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
