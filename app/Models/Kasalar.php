<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kasalar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    //Silme Kontrolü
    public function odeme()
    {
        return $this->hasMany(Odemeler::class, 'kasa_id');
    }
    public function tahsilat()
    {
        return $this->hasMany(Tahsilat::class, 'kasa_id');
    }



}
