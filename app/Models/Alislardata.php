<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alislardata extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function giderkategori()
    {
        return $this->belongsTo(Giderkategori::class,'giderkategori_id');
    }

    public function gider()
    {
        return $this->belongsTo(Gider::class,'gider_id');
    }
}

