<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kasahrkt extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function kasa()
{
    return $this->belongsTo(Kasalar::class, 'kasa_id');
}
public function odeme()
    {
        return $this->belongsTo(Odemeler::class, 'odeme_id');
    }
    public function tahsilat()
    {
        return $this->belongsTo(Tahsilat::class, 'tahsilat_id');
    }
}
