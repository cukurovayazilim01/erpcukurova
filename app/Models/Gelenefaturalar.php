<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gelenefaturalar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uuid',
        'fatura_no',
        'profile_id',
        'type_code',
        'issue_date',
        'currency',
        'note',
        'notes',
        'sender_name',
        'sender_vkn_tckn',
        'sender_city',
        'sender_city_subdivision',
        'sender_tax_office',
        'sender_email',
        'receiver_name',
        'receiver_vkn_tckn',
        'receiver_city',
        'receiver_city_subdivision',
        'receiver_tax_office',
        'receiver_email',
        'line_extension',
        'line_extension_currency',
        'tax_exclusive',
        'tax_exclusive_currency',
        'tax_inclusive',
        'tax_inclusive_currency',
        'allowance',
        'allowance_currency',
        'payable',
        'payable_currency',
        'tax_amount',
        'tax_amount_currency',
        'tax_subtotals',
        'tax_totals',
        'json_data',
        'alis_aktarilma_durum'
    ];



}
