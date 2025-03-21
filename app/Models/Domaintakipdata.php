<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domaintakipdata extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function domain()
    {
        return $this->belongsTo(Domaintakip::class,'domaintakip_id');
    }
    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'satis_temsilcisi');
    }
}
