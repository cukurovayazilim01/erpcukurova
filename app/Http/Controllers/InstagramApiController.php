<?php

namespace App\Http\Controllers;

use App\Models\accountapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class InstagramApiController extends Controller
{

    public function redirect()
    {
        $url = 'https://www.instagram.com/oauth/authorize' .
            '?client_id=' . config('services.instagram.client_id') .
            '&redirect_uri=' . urlencode(route('instagram.callback')) .
            '&scope=instagram_basic,instagram_content_publish' .
            '&response_type=code';

        return redirect($url);
    }

    public function callback(Request $request)
    {
        $response = Http::asForm()->post('https://api.instagram.com/oauth/access_token', [
            'client_id' => config('services.instagram.client_id'),
            'client_secret' => config('services.instagram.client_secret'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => route('instagram.callback'),
            'code' => $request->code,
        ]);

        $data = $response->json();

        if (!isset($data['access_token'])) {
            return redirect()->route('instagram.redirect')->with('error', 'Erişim alınamadı.');
        }

        $shortToken = $data['access_token'];
        $instagramUserId = $data['user_id'];

        $longTokenRes = Http::get('https://graph.instagram.com/access_token', [
            'grant_type' => 'ig_exchange_token',
            'client_secret' => config('services.instagram.client_secret'),
            'access_token' => $shortToken,
        ]);

        $longToken = $longTokenRes['access_token'] ?? null;

        // Username'i çek
        $usernameRes = Http::get("https://graph.instagram.com/{$instagramUserId}", [
            'fields' => 'username',
            'access_token' => $longToken,
        ]);
        $username = $usernameRes['username'] ?? 'Instagram Kullanıcısı';

        accountapi::updateOrCreate(
            ['instagram_account_id' => $instagramUserId],
            [
                'islem_yapan' => Auth::id(),
                'islem_tarihi' => now(),
                'access_token' => $longToken,
                'account_name' => $username,
                'platform_tipi' => 'Instagram',
                'status' => 'Aktif'
            ]
        );

        return redirect()->back()->with('success', 'Instagram hesabı başarıyla bağlandı.');
    }

    public function post(Request $request)
    {
        $account = accountapi::findOrFail($request->accountapi_id);

        $imageUrl = $request->image_url;
        $caption = $request->caption;

        $create = Http::post("https://graph.facebook.com/v19.0/{$account->instagram_account_id}/media", [
            'image_url' => $imageUrl,
            'caption' => $caption,
            'access_token' => $account->access_token,
        ]);

        $creationId = $create['id'] ?? null;

        if (!$creationId) {
            return back()->with('error', 'Medya oluşturulamadı: ' . json_encode($create->json()));
        }

        $publish = Http::post("https://graph.facebook.com/v19.0/{$account->instagram_account_id}/media_publish", [
            'creation_id' => $creationId,
            'access_token' => $account->access_token,
        ]);

        return back()->with('success', 'Gönderi başarıyla paylaşıldı.');
    }



        public function redirectToInstagram()
    {
        $query = http_build_query([
            'client_id' => config('services.instagram.client_id'),
            'redirect_uri' => config('services.instagram.redirect'),
            'scope' => 'user_profile,user_media',
            'response_type' => 'code',
        ]);

        return redirect("https://api.instagram.com/oauth/authorize?$query");
    }

    public function handleInstagramCallback(Request $request)
{
    if (!$request->has('code')) {
        return redirect()->route('instagram')->with('error', 'Instagram yetkilendirme reddedildi.');
    }

    // Access Token al
    $tokenResponse = Http::asForm()->post('https://api.instagram.com/oauth/access_token', [
        'client_id' => config('services.instagram.client_id'),
        'client_secret' => config('services.instagram.client_secret'),
        'grant_type' => 'authorization_code',
        'redirect_uri' => config('services.instagram.redirect'),
        'code' => $request->code,
    ]);

    $tokenData = $tokenResponse->json();

    if (!isset($tokenData['access_token'])) {
        return redirect()->route('instagram')->with('error', 'Instagram token alınamadı.');
    }

    $accessToken = $tokenData['access_token'];
    $userId = $tokenData['user_id'];

    // Kullanıcı bilgilerini al
    $userResponse = Http::get("https://graph.instagram.com/{$userId}", [
        'fields' => 'id,username,account_type,media_count',
        'access_token' => $accessToken,
    ]);

    $userData = $userResponse->json();

    if (!isset($userData['id'])) {
        return redirect()->route('instagram')->with('error', 'Instagram kullanıcı bilgileri alınamadı.');
    }

    // Aktif hesabı devre dışı bırak
    accountapi::where('status', 'Aktif')->update(['status' => 'Pasif']);

    // Yeni hesabı kaydet
    accountapi::create([
        'instagram_account_id' => $userData['id'],
        'access_token' => $accessToken,
        'status' => 'Aktif',
    ]);

    return redirect()->route('instagram')->with('success', 'Instagram hesabı başarıyla bağlandı.');
}

}
