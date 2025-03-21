<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satislar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function hizmetlerkategori()
    {
        return $this->belongsTo(Hizmetlerkategori::class,'hizmetlerkategori_id');
    }

    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }
    public function hizmetler()
    {
        return $this->belongsTo(Hizmetler::class,'hizmet_id');
    }
    public function satislardata()
    {
        return $this->hasMany(Satislardata::class, 'satis_id', 'id');
    }
    public function teklifler()
    {
        return $this->belongsTo(Teklifler::class,'teklif_id');
    }
}
