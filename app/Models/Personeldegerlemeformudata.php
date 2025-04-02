<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personeldegerlemeformudata extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function degerlendirmeler()
    {
        return $this->hasMany(Personeldegerlemeformu::class,'id');
    }
}
