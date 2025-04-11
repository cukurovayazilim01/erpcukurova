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

        $sosyalmedya = new Sosyalmedya();
        $sosyalmedya->islem_yapan     = Auth::user()->id;
        $sosyalmedya->islem_tarihi    = Carbon::now();
        $sosyalmedya->gonderi_tipi    = $request->gonderi_tipi;
        $sosyalmedya->gonderi_zamani  = $request->gonderi_zamani;
        $sosyalmedya->gonderi_adi     = $request->gonderi_adi;
        $sosyalmedya->gonderi_boyutu  = $request->gonderi_boyutu;
        $sosyalmedya->text            = $request->text;
        $sosyalmedya->platforms       = implode(',', $request->service);

        $dosyaYollar = [];

        if ($request->hasFile('resim')) {
            foreach ($request->file('resim') as $index => $dosya) {
                $uzanti = strtolower($dosya->getClientOriginalExtension());

                $gonderiAdi = str_replace(
                    ['ı','ğ','ü','ş','ö','ç','İ','Ğ','Ü','Ş','Ö','Ç'],
                    ['i','g','u','s','o','c','I','G','U','S','O','C'],
                    $sosyalmedya->gonderi_adi
                );
                $gonderiAdi = preg_replace('/[^A-Za-z0-9\-_.]/', '', str_replace(' ', '-', $gonderiAdi));
                $dosyaAdi = $gonderiAdi . '-' . time() . '-' . $index . '.' . $uzanti;

                $dosya->move(public_path('/sosyalmedyalarimiz/resim'), $dosyaAdi);
                $dosyaYollar[] = '/sosyalmedyalarimiz/resim/' . $dosyaAdi;

                $tamUrl = url($dosyaYollar[$index]);
                $this->debugFacebookUrl($tamUrl);
            }
        }

        $sosyalmedya->resim = json_encode($dosyaYollar);
        $sosyalmedya->save();

        $caption = $request->input('caption');
        $altText = $request->input('alt_text');

        $tamUrlList = array_map(fn($path) => url($path), $dosyaYollar);
        $creationIds = [];

        // Eğer birden fazla dosya varsa carousel gönderisi yap
        if (count($tamUrlList) > 1) {
            foreach ($tamUrlList as $index => $mediaUrl) {
                $uzanti = pathinfo($mediaUrl, PATHINFO_EXTENSION);
                $isVideo = in_array(strtolower($uzanti), ['mp4', 'mov', 'avi', 'wmv', 'mkv']);

                if ($isVideo) {
                    $mediaResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", [
                        'media_type'   => 'VIDEO',
                        'video_url'    => $mediaUrl,
                        'is_carousel_item' => true,
                        'access_token' => $accessToken,
                    ]);
                } else {
                    $mediaResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", [
                        'image_url'    => $mediaUrl,
                        'is_carousel_item' => true,
                        'access_token' => $accessToken,
                    ]);
                }

                $mediaData = $mediaResponse->json();
                if (isset($mediaData['id'])) {
                    $creationIds[] = $mediaData['id'];
                }
            }

            // Carousel Container oluştur
            $containerResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", [
                'media_type'     => 'CAROUSEL',
                'children'       => $creationIds,
                'caption'        => $caption,
                'access_token'   => $accessToken,
            ]);

            $containerData = $containerResponse->json();
            if (!isset($containerData['id'])) {
                return back()->with('error', 'Carousel oluşturulamadı: ' . json_encode($containerData));
            }

            // Yayınla
            $creationId = $containerData['id'];
        } else {
            // Tek dosya için işlem (resim veya video)
            $mediaUrl = $tamUrlList[0];
            $uzanti = pathinfo($mediaUrl, PATHINFO_EXTENSION);
            $isVideo = in_array(strtolower($uzanti), ['mp4', 'mov', 'avi', 'wmv', 'mkv']);

            if ($isVideo) {
                $mediaResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", [
                    'media_type'   => 'VIDEO',
                    'video_url'    => $mediaUrl,
                    'caption'      => $caption,
                    'access_token' => $accessToken,
                ]);
            } else {
                $mediaResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", [
                    'image_url'    => $mediaUrl,
                    'caption'      => $caption,
                    'access_token' => $accessToken,
                    'alt_text'     => ['custom' => $altText],
                ]);
            }

            $mediaData = $mediaResponse->json();
            if (!isset($mediaData['id'])) {
                return back()->with('error', 'Medya oluşturulamadı: ' . json_encode($mediaData));
            }

            $creationId = $mediaData['id'];
        }

        // Yayınlama adımı
        $publishResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media_publish", [
            'creation_id'   => $creationId,
            'access_token'  => $accessToken,
        ]);

        $publishData = $publishResponse->json();

        if (!isset($publishData['id'])) {
            return back()->with('error', 'Yayınlama başarısız: ' . json_encode($publishData));
        }

        return back()->with('success', 'Instagram gönderisi başarıyla paylaşıldı!');
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
