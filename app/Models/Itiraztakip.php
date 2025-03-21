<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itiraztakip extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function referansno()
    {
        return $this->belongsTo(Markatakip::class,'markatakip_id');
    }
    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }

}
