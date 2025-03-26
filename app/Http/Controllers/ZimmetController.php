<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use App\Models\User;
use App\Models\Zimmet;
use App\Models\Zimmetdata;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ZimmetController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function zimmetsearch(Request $request)
    {
        $zimmetsearch = $request->input('zimmetsearch');

        // Eğer arama yapılmışsa filtre uygula, yoksa tüm verileri çek
        $zimmet = Zimmet::with('personel') // İlişkili personel verisini çek
        ->orderByDesc('id')
        ->when(!empty($zimmetsearch), function ($query) use ($zimmetsearch) {
            $query->whereHas('personel', function ($subQuery) use ($zimmetsearch) {
                $subQuery->where('ad_soyad', 'like', '%' . $zimmetsearch . '%');
            });
        })
        ->paginate(50);


        // Sayfa numarasını hesapla
        $page = $request->query('page', 1);
        $perPage = 50;
        $startNumber = $zimmet->total() - (($page - 1) * $perPage);


        // AJAX isteği ise sadece arama sonuçlarını döndür
        if ($request->ajax()) {
            return view('admin.contents.zimmet.zimmet-search', compact('zimmet', 'startNumber'));
        }

        // Normal sayfa için tüm veriyi döndür
        return view('admin.contents.zimmet.zimmet', compact('zimmet', 'startNumber'));
    }
    public function index()
    {
        $zimmet = Zimmet::all();
        $user = User::all();
        $personel = Personel::all();
        $zimmetdata = Zimmetdata::all();
        return view('admin.contents.zimmet.zimmet',compact('zimmetdata','zimmet','user','personel'));
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
        $zimmet = new Zimmet();
        $zimmet->islem_yapan = Auth::user()->id;
        $zimmet->islem_tarihi = Carbon::now();
        $zimmet->personel_id = $request->personel_id;
        $zimmet->save();

        $inputss = $request->input('inputss');

        foreach ($inputss as $key => $inputs) {
            $zimmetdata = new Zimmetdata();
            $zimmetdata->zimmet_id = $zimmet->id;
            $zimmetdata->verilme_tarihi = $inputs['verilme_tarihi'];
            $zimmetdata->marka = $inputs['marka'];
            $zimmetdata->model = $inputs['model'];
            $zimmetdata->miktar = $inputs['miktar'];
            $zimmetdata->birim = $inputs['birim'];

            if ($request->hasFile("inputss.$key.verme_dosya")) {
                $file = $request->file("inputss.$key.verme_dosya");
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = str_replace(' ', '-', $inputs['marka']) . '-' . time() . '.' . $fileExtension;
                $filePath = public_path('/zimmetevraklari');
                $file->move($filePath, $fileName);
                $zimmetdata->verme_dosya = '/zimmetevraklari/' . $fileName;
            }

            $zimmetdata->save();
        }

        return redirect('zimmet')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $zimmet = Zimmet::find($id);
        $zimmetdata = Zimmetdata::where('zimmet_id',$zimmet->id)->get();
        $personel = Personel::all();
        return view('admin.contents.zimmet.zimmet-show',compact('zimmet','zimmetdata','personel'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $zimmet = Zimmet::find($id);
        $zimmetdata = Zimmetdata::where('zimmet_id',$zimmet->id)->get();
        $personel = Personel::all();
        return view('admin.contents.zimmet.zimmet-update',compact('zimmet','zimmetdata','personel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $zimmet = Zimmet::find($id);

        $inputs = $request->input('inputss');

        $olansatirzimmetdata = $zimmet->zimmetdata;

        foreach ($inputs as $key => $input) {
                // VAR OLAN SATIRI GĞNCELER
                $zimmetdata = $olansatirzimmetdata[$key];
                $zimmetdata->verilme_tarihi = $input['verilme_tarihi'];
                $zimmetdata->marka = $input['marka'];
                $zimmetdata->model = $input['model'];
                $zimmetdata->miktar = $input['miktar'];
                $zimmetdata->birim = $input['birim'];
                if ($request->hasFile("inputss.$key.verme_dosya")) {
                    $file = $request->file("inputss.$key.verme_dosya");
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = str_replace(' ', '-', $inputs['marka']) . '-' . time() . '.' . $fileExtension;
                    $filePath = public_path('/zimmetevraklari');
                    $file->move($filePath, $fileName);
                    $zimmetdata->verme_dosya = '/zimmetevraklari/' . $fileName;
                }
                $zimmetdata->geri_alma_tarihi = $input['geri_alma_tarihi'];
                $zimmetdata->geri_alma_miktar = $input['geri_alma_miktar'];
                $zimmetdata->durum = $input['durum'];
                $zimmetdata->aciklama = $input['aciklama'];
                if ($request->hasFile("inputss.$key.alma_dosya")) {
                    $file = $request->file("inputss.$key.alma_dosya");
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName =  '-' . time() . '.' . $fileExtension;
                    $filePath = public_path('/zimmetevraklari');
                    $file->move($filePath, $fileName);
                    $zimmetdata->alma_dosya = '/zimmetevraklari/' . $fileName;
                }
                $zimmetdata->save();
            }
            return redirect('zimmet')->with('success','Güncelleme Başarılı');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
