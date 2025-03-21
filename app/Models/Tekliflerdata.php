<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tekliflerdata extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function hizmetlerkategori()
    {
        return $this->belongsTo(Hizmetlerkategori::class,'hizmetlerkategori_id');
    }

    public function hizmetler()
    {
        return $this->belongsTo(Hizmetler::class,'hizmet_id');
    }

}
