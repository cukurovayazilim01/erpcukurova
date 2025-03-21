<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hizmetlerkategori extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    public function hizmetler()
    {
        return $this->hasMany(Hizmetler::class);
    }
    public function tekliflerdata()
    {
        return $this->hasMany(Tekliflerdata::class,'hizmetlerkategori_id');
    }
    public function satislardata()
    {
        return $this->hasMany(Satislardata::class,'hizmetlerkategori_id');
    }
}
