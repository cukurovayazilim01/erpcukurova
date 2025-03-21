<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aramalar extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function cariler()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }
    public function adsoyad()
    {
        return $this->belongsTo(User::class,'islem_yapan');
    }
}
