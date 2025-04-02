<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pyillikhedefler extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    public function personel()
    {
        return $this->belongsTo(Personel::class,'personel_id');
    }
    public function hedefkonu()
    {
        return $this->belongsTo(YillikHedefkonu::class,'hedef_konusu_id');
    }

}
