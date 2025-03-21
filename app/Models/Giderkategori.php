<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Giderkategori extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function gider()
    {
        return $this->hasMany(Gider::class);
    }
    public function alislardata()
    {
        return $this->hasMany(Alislardata::class,'giderkategori_id');
    }
}
