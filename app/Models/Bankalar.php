<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bankalar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function adsoyad()
    {
        return $this->belongsTo(User::class,'user_id');
    }
     //Silme Kontrolü
     public function odeme()
     {
         return $this->hasMany(Odemeler::class, 'banka_id');
     }
     public function tahsilat()
     {
         return $this->hasMany(Tahsilat::class, 'banka_id');
     }

}
