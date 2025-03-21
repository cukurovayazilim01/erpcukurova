<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aktiflog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function adsoyad()
    {
        return $this->belongsTo(User::class,'islemiyapan_id');
    }
}
