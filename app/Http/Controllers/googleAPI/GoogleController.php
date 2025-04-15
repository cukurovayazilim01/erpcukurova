<?php

namespace App\Http\Controllers\googleAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\MyBusinessAccountManagement;
use Illuminate\Support\Facades\Http;
use App\Models\GoogleBusinessAccount;
use App\Models\GoogleBusinessLocation;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope([
            'https://www.googleapis.com/auth/business.manage',
            'https://www.googleapis.com/auth/plus.login',
            'openid',
            'email',
            'profile',
        ]);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }
}
