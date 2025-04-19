<?php

namespace App\Http\Controllers;

use App\Models\accountapi;
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
                'instagram_manage_insights',
                'instagram_content_publish',
                'business_management',
                'instagram_manage_comments',
                'pages_manage_posts'

            ])
            ->redirect();
    }

    public function callback(Request $request)
{
    $user = Socialite::driver('facebook')->user();
    $accessToken = $user->token;

    $pages = Http::get("https://graph.facebook.com/v22.0/me/accounts", [
        'access_token' => $accessToken
    ])->json();

    if (!empty($pages['data'])) {
        $pageId = $pages['data'][0]['id'];
        $pageAccessToken = $pages['data'][0]['access_token'];

        $pageInfo = Http::get("https://graph.facebook.com/v22.0/{$pageId}", [
            'fields' => 'name,instagram_business_account',
            'access_token' => $pageAccessToken
        ])->json();

        if (isset($pageInfo['instagram_business_account']['id'])) {
            $instagramId = $pageInfo['instagram_business_account']['id'];

            $igUser = Http::get("https://graph.facebook.com/v22.0/{$instagramId}", [
                'fields' => 'username',
                'access_token' => $pageAccessToken
            ])->json();

            // Diğer tüm hesapları pasif yap
            accountapi::where('status', 'Aktif')->update(['status' => 'Pasif']);

            // Eğer daha önce kayıtlıysa güncelle, yoksa oluştur
            accountapi::updateOrCreate(
                ['instagram_account_id' => $instagramId], // eşleşme kriteri
                [
                    'islem_yapan' => Auth::user()->id,
                    'islem_tarihi' => Carbon::now(),
                    'access_token' => $accessToken,
                    'account_name' => $igUser['username'] ?? null,
                    'status' => 'Aktif',
                    'platform_tipi' => 'İnstagram',
                ]
            );

            return redirect()->route('instagram')->with('success', 'Instagram hesabı başarıyla bağlandı.');
        }
    }

    return redirect()->route('instagram')->with('error', 'Kullanıcının yönetici olduğu bir sayfa bulunamadı.');
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

    $instagramAccount = accountapi::findOrFail($request->accountapi_id);
    $accessToken = $instagramAccount->access_token;
    $instagramAccountId = $instagramAccount->instagram_account_id;

    if (!$accessToken || !$instagramAccountId) {
        return back()->with('error', 'Instagram oturumu eksik.');
    }

    $gonderiTipi = $request->gonderi_tipi;

    // Sosyal medya kayıt işlemi
    $sosyalmedya = new Sosyalmedya();
    $sosyalmedya->islem_yapan = Auth::id();
    $sosyalmedya->islem_tarihi = now();
    $sosyalmedya->gonderi_tipi = match($gonderiTipi) {
        'isReels' => 'REELS',
        'isCarousel' => 'CAROUSEL',
        default => 'GÖRSEL',
    };
    $sosyalmedya->gonderi_adi = $request->gonderi_adi;
    $sosyalmedya->text = $request->text;
    $sosyalmedya->platforms = implode(',', $request->service);
    $sosyalmedya->save();

    // Dosyaları yükle
    $mediaUrls = [];
    if ($request->hasFile('resim')) {
        foreach ($request->file('resim') as $index => $dosya) {
            $ext = strtolower($dosya->getClientOriginalExtension());

            // ❌ Tekli gönderide video varsa uyarı
            if ($gonderiTipi === 'normal' && in_array($ext, ['mp4', 'mov'])) {
                return back()->with('error', 'Video gönderileri yalnızca Reels veya Carousel olarak paylaşılabilir.');
            }

            $slugName = preg_replace('/[^A-Za-z0-9\-_.]/', '', str_replace(' ', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $sosyalmedya->gonderi_adi)));
            $fileName = $slugName . '-' . time() . '-' . $index . '.' . $ext;
            $dosya->move(public_path('/sosyalmedyalarimiz/resim'), $fileName);
            $mediaUrls[] = url('/sosyalmedyalarimiz/resim/' . $fileName);
        }
    }

    // Instagram medya oluşturma
    $creationIds = [];

    foreach ($mediaUrls as $mediaUrl) {
        $ext = pathinfo($mediaUrl, PATHINFO_EXTENSION);
        $isVideo = in_array($ext, ['mp4', 'mov']);

        if ($gonderiTipi === 'isReels') {
            if (!$isVideo) {
                return back()->with('error', 'Reels gönderisi sadece video olabilir.');
            }

            $params = [
                'media_type' => 'REELS',
                'video_url' => $mediaUrl,
                'caption' => $request->text,
                'access_token' => $accessToken,
            ];
        } elseif ($gonderiTipi === 'isCarousel') {
            $params = [
                $isVideo ? 'video_url' : 'image_url' => $mediaUrl,
                'is_carousel_item' => true,
                'access_token' => $accessToken,
            ];
        } else {
            // Tekli görsel (video olamaz)
            $params = [
                'image_url' => $mediaUrl,
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

    // Hazırlık bekleme
    foreach ($creationIds as $creationId) {
        $ready = false;
        for ($i = 0; $i < 10; $i++) {
            sleep(3);
            $check = Http::get("https://graph.facebook.com/v22.0/{$creationId}?fields=status_code&access_token={$accessToken}");
            $status = $check->json();

            if (isset($status['status_code']) && $status['status_code'] === 'FINISHED') {
                $ready = true;
                break;
            }

            if (isset($status['error'])) {
                \Log::warning('Instagram API bekleme hatası', $status);
                continue;
            }
        }

        if (!$ready) {
            return back()->with('error', 'Medya hazır hale gelmedi: ' . $creationId);
        }
    }

    // Carousel yayını
    if ($gonderiTipi === 'isCarousel') {
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

    $instagramAccount = accountapi::where('status', 'Aktif')
                                        ->first();
    $accessToken = $instagramAccount->access_token;
    $instagramAccountId = $instagramAccount->instagram_account_id;


    if (!$accessToken || !$instagramAccountId) {
        return view('admin.contents.smhesaplarilist.instagram.instagram', [
            'data' => ['error' => 'Instagram hesabı bağlı değil ya da oturum süresi dolmuş.']
        ]);
    }

    $username = $request->input('user_name');

    if (!$username) {
        return view('admin.contents.smhesaplarilist.instagram.instagram', [
            'data' => ['error' => 'Instagram kullanıcı adı (user_name) belirtilmedi.']
        ]);
    }

    try {
        $response = Http::get("https://graph.facebook.com/v22.0/{$instagramAccountId}", [
    'fields' => "business_discovery.username($username){followers_count,media_count,media{comments_count,like_count,media_url,media_type,caption,timestamp,id},name,biography,website,profile_picture_url}",
    'access_token' => $accessToken,
]);

if ($response->successful()) {
    $data = $response->json();
    $mediaItems = $data['business_discovery']['media']['data'] ?? [];

    foreach ($mediaItems as &$media) {

        // Medya ID'si ile yorumları çek
        $commentsResponse = Http::get("https://graph.facebook.com/v22.0/{$media['id']}/comments", [
            'access_token' => $accessToken,
            'fields' => 'text,timestamp'
        ]);

        if ($commentsResponse->successful())
       {
            $commentsData = $commentsResponse->json();

            $media['comments'] = $commentsData['data'] ?? [];
        } else {
            $media['comments'] = []; // yorumlar alınamadıysa boş array
        }
    }

    return view('admin.contents.smhesaplarilist.instagram.instagram', [
        'data' => [
            'followers' => $data['business_discovery']['followers_count'] ?? 0,
            'media_count' => $data['business_discovery']['media_count'] ?? 0,
            'media' => $mediaItems,
            'name' => $data['business_discovery']['name'] ?? null,
            'biography' => $data['business_discovery']['biography'] ?? null,
            'website' => $data['business_discovery']['website'] ?? null,
            'profile_picture_url' => $data['business_discovery']['profile_picture_url'] ?? null,
        ]
    ]);
}

        return view('admin.contents.smhesaplarilist.instagram.instagram', [
            'data' => ['error' => 'Instagram verileri alınamadı.']
        ]);

    } catch (\Exception $e) {
        return view('admin.contents.smhesaplarilist.instagram.instagram', [
            'data' => ['error' => 'Bir hata oluştu: ' . $e->getMessage()]
        ]);
    }
}
    public function replyToComment(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|string',
            'message' => 'required|string',
        ]);

        $accessToken = session('access_token');

        $response = Http::post("https://graph.facebook.com/v22.0/{$request->comment_id}/replies", [
            'access_token' => $accessToken,
            'message' => $request->message
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Yorum yanıtlandı!');
        }

        return back()->with('error', 'Yanıt gönderilemedi.');
    }

    public function deleteComment(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|string',
        ]);

        $accessToken = session('access_token');

        $response = Http::withToken($accessToken)->delete("https://graph.facebook.com/v22.0/{$request->comment_id}");


        if ($response->successful()) {
            return back()->with('success', 'Yorum silindi!');
        }


        return back()->with('error', 'Yorum silinemedi.');
    }

public function instagram()
{
    return view('admin.contents.smhesaplarilist.instagram.instagram', [
        'data' => []
    ]);
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
