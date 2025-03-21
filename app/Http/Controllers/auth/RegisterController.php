<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function usersearch(Request $request)
    {
        $query = $request->input('query');

        // Kullanıcıları arayın
        $user = User::where('ad_soyad', 'like', "%$query%")->get();

        // Arama sonuçlarını bir blade şablonu kullanarak döndürün
        return view('admin.user.users', compact('user'));
    }

    public function userresetpasswordPOST($id,Request $request)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('anasayfa');
    }

    public function userresetpassword()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.user.resetuserpassword', compact('user'));
    }

    public function sifredegistir($id,Request $request)
    {
        $user= User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return back();
    }

    public function index()
    {
        $roles = Role::all();
        $user = User::with('roles')->where('id' ,'>',0)->get();
        return view('admin.user.users',compact('user','roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.register',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user -> username = $request -> username;
        $user -> password = bcrypt($request->password);
        $user -> ad_soyad = $request -> ad_soyad;
        $user -> departman = $request -> departman;
        $user -> gorev = $request -> gorev;
        $user -> durum = $request -> durum;
        $user -> telefon = $request -> telefon;
        $user -> email = $request -> email;
        if ($request->hasFile('resim')) 
        {
            $fileExtension = $request->resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', time().'-'.  $user->ad_soyad) . '.' . $fileExtension;
            $request->resim->move(public_path('resim'), $imageName);
            $user->resim='/resim/'.$imageName;
        }
        $user ->save();
        $user->syncRoles($request->role);
        return redirect('register')->with('success','Kullanıcı Oluşturuldu');
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
        $roles = Role::all();
        $user = User::find($id);
        return view('admin.user.register-update',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $user = User::find($id);
        $user -> username = $request -> username;
        $user -> ad_soyad = $request -> ad_soyad;
        $user -> departman = $request -> departman;
        $user -> gorev = $request -> gorev;
        $user -> durum = $request -> durum;
        $user -> telefon = $request -> telefon;
        $user -> email = $request -> email;
        if ($request->hasFile('resim')) 
        {
            $fileExtension = $request->resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', time().'-'.  $user->ad_soyad) . '.' . $fileExtension;
            $request->resim->move(public_path('resim'), $imageName);
            $user->resim='/resim/'.$imageName;
        }
        
    // Güncellenmek istenen kullanıcı adı
    $newUsername = $user['username'];

    // Mevcut kullanıcı adına sahip başka bir kayıt var mı kontrol edin
    $existingUser = User::where('username', $newUsername)
                        ->where('id', '!=', $id)
                        ->first();

    if ($existingUser) {
        return redirect()->back()->with('error', 'Güncellemek İçin Girdiginiz kullanıcı adı zaten kullanılıyor.');
    }
        $user->save();

        $user->syncRoles($request->role);
        return redirect('register')->with('success','Kullanıcı Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('register')->with('success','Kullanıcı Silindi');
    }
}
