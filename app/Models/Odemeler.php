<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Odemeler extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }

    public function bankaadi()
    {
        return $this->belongsTo(Bankalar::class,'banka_id');
    }
    public function kasaadi()
    {
        return $this->belongsTo(Kasalar::class,'kasa_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'odemeyapan_id');
    }

}
