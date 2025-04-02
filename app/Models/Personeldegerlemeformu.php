<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personeldegerlemeformu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function personel()
    {
        return $this->belongsTo(Personel::class,'personel_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'islem_yapan');
    }
}
