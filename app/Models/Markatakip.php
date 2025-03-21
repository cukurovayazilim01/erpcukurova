<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Markatakip extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class,'islem_yapan');
    }
    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }
    public function hizmet()
    {
        return $this->belongsTo(Hizmetler::class,'hizmet_turu');
    }
    public function satistemsilcisi()
    {
        return $this->belongsTo(User::class,'satis_temsilcisi');
    }
    public function itiraz()
    {
        return $this->hasMany(Itiraztakip::class,'markatakip_id');
    }

}
