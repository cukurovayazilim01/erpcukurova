<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gidenefaturadata extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'gidenefatura_id',
        'name',
        'quantity',
        'quantity_unit',
        'price',
        'price_currency',
        'extension_amount',
        'extension_amount_currency',
        'tax_amount',
        'tax_amount_currency',
        'tax_percent',
        'taxable',
        'taxable_currency',
        'tax_total_amount'
    ];

    public function gidenefatura()
    {
        return $this->belongsTo(Gidenefaturalar::class);
    }
}
