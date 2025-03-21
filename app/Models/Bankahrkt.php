<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bankahrkt extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function banka()
    {
        return $this->belongsTo(Bankalar::class, 'banka_id');
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
