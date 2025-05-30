<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahsilatplan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');
    }

    public function islemyapan()
    {
        return $this->belongsTo(User::class,'islem_yapan');

    }
}
