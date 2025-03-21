<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teklifler extends Model
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

    public function tekliflerdata()
    {
        return $this->hasMany(Tekliflerdata::class, 'teklif_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');

    }
}

