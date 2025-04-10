<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return redirect()->route('sosyalmedya.create')->with('success', 'Instagram hesabı başarıyla bağlandı.');
    }

    return redirect()->route('sosyalmedya.create')->with('error', 'Kullanıcının yönetici olduğu bir sayfa bulunamadı.');
}


    public function postToInstagram(Request $request)
    {
        $accessToken = session('access_token'); // Callback'ten alınıp session'a atılmış olmalı
        $instagramAccountId = session('instagram_account_id'); // Aynı şekilde session'da olmalı

        if (!$accessToken || !$instagramAccountId) {
            return back()->with('error', 'Instagram oturumu eksik.');
        }

        $imageUrl = $request->input('image_url');
        $caption = $request->input('caption');
        $altText = $request->input('alt_text');

        // 1. Medya oluşturma
        $mediaResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media", [
            'image_url' => $imageUrl,
            'caption' => $caption,
            'access_token' => $accessToken,
            'alt_text' => ['custom' => $altText],
        ]);

        $mediaData = $mediaResponse->json();

        if (!isset($mediaData['id'])) {
            return back()->with('error', 'Medya oluşturulamadı: ' . json_encode($mediaData));
        }

        // 2. Yayına alma
        $creationId = $mediaData['id'];
        $publishResponse = Http::post("https://graph.facebook.com/v22.0/{$instagramAccountId}/media_publish", [
            'creation_id' => $creationId,
            'access_token' => $accessToken,
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
