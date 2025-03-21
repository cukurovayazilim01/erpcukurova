<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Virman extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class,'islem_yapan');
    }
    public function birincikasa()
    {
        return $this->belongsTo(Kasalar::class,'birinci_kasa');
    }
    public function ikincikasa()
    {
        return $this->belongsTo(Kasalar::class,'ikinci_kasa');
    }

    public function birincibanka()
    {
        return $this->belongsTo(Bankalar::class,'birinci_banka');
    }
    public function ikincibanka()
    {
        return $this->belongsTo(Bankalar::class,'ikinci_banka');
    }
}
