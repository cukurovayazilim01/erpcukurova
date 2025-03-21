<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hizmetler extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    public function hizmetlerkategori()
    {
        return $this->belongsTo(Hizmetlerkategori::class,'hizmetler_kategori_id');
    }
    public function tekliflerdata()
    {
        return $this->hasMany(Tekliflerdata::class,'hizmet_id');
    }
    public function satislardata()
    {
        return $this->hasMany(Satislardata::class,'hizmet_id');
    }
}
