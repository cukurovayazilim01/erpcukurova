<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cariler extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teklifler()
    {
        return $this->hasMany(Teklifler::class, 'cari_id');
    }

    public function satislar()
    {
        return $this->hasMany(Satislar::class, 'cari_id');
    }

    public function tahsilatlar()
    {
        return $this->hasMany(Tahsilat::class, 'cari_id');
    }

    public function alislar()
    {
        return $this->hasMany(Alislar::class, 'cari_id');
    }
    public function odemeler()
    {
        return $this->hasMany(Odemeler::class, 'cari_id');
    }
    public function ceksenet()
    {
        return $this->hasMany(Ceksenet::class, 'cari_id');
    }
    public function aramakaydi()
    {
        return $this->hasMany(Aramalar::class, 'cari_id');
    }
    public function kontaklist()
    {
        return $this->hasMany(Kontak::class, 'cari_id');
    }

}
