<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesType extends Model
{
    use HasFactory;

    protected $table = 'sales_types';

    protected $fillable = [
        'type_name',
        'factor',
        'tax_incl',
        'status'
    ];

    protected $casts = [
        'factor' => 'decimal:2',
        'tax_incl' => 'boolean',
    ];
}
