<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Firmahrkt extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }
    public function satis()
    {
        return $this->belongsTo(Satislar::class,'satis_id','id');
    }
    public function satislardata()
    {
        return $this->hasOne(Satislardata::class, 'satis_id', 'satis_id');
    }
    public function alis()
    {
        return $this->belongsTo(Alislar::class,'alis_id','id');
    }
    public function tahsilat()
    {
        return $this->belongsTo(Tahsilat::class,'tahsilat_id','id');
    }
    public function odeme()
    {
        return $this->belongsTo(Odemeler::class,'odeme_id','id');
    }
    public function kasahrkt()
    {
        return $this->belongsTo(Kasahrkt::class,'kasahareket_id','id');
    }
    public function bankahrkt()
    {
        return $this->belongsTo(Bankahrkt::class,'bankahareket_id','id');
    }
    public function ceksenet()
    {
        return $this->belongsTo(Ceksenet::class,'ceksenet_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'islem_yapan','id');
    }



}

