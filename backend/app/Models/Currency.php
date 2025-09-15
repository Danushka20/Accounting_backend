<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'currency_abbreviation',
        'currency_symbol',
        'currency_name',
        'hundredths_name',
        'country',
        'auto_exchange_rate_update',
    ];
}
