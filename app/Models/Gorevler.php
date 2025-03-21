<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gorevler extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'islem_yapan');
    }

    public function firmaadi()
    {
        return $this->belongsTo(Cariler::class,'cari_id');

    }
    public function gorevlendirilen()
    {
        return $this->belongsTo(User::class,'gorevlendirilen_id');
    }
}
