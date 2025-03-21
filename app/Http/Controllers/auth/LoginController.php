<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Aktiflog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function userlogin(Request $request)
    {
        // Error messages
        $messages = [
            "username.required" => "KULLANICI ADI ZORUNLUDUR",
            "password.required" => "ŞİFRE ZORUNLUDUR",
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()
                         ->with('error', 'Formda eksik alanlar var. Lütfen kontrol edin.');
        } else {
            // attempt to log
            if (Auth::attempt([
                    'username' => $request->username,
                    'password' => $request->password
                ], $request->remember))
            {
                $log = new Aktiflog();
                $log->islem_tarihi = Carbon::now();
                $log->islemiyapan_id = Auth::user()->id;
                $log->islem = 'Giriş Yaptı';
                $log->save();
                return redirect()->intended(route('anasayfa'))
                                 ->with('success', 'Giriş Başarılı');
            }

            return redirect()->back()->withInput($request->only('username', 'remember'))
                                     ->with('error', 'Kullanıcı Adı Yada Şifre Hatalı');
        }
    }

    public function logout(Request $request)
    {
        $log = new Aktiflog();
                $log->islem_tarihi = Carbon::now();
                $log->islemiyapan_id = Auth::user()->id;
                $log->islem = 'Çıkış Yaptı';
                $log->save();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::warning('Başarılı', 'Çıkış Başarılı');
        return redirect('/');
    }
}
