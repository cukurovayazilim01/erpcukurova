<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tescilnoksan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    public function referansno()
    {
        return $this->belongsTo(Markatakip::class,'markatakip_id');
    }
}
