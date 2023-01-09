<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'initial_month',
        'factory_tmh',
        'trader',
        'trader_number',
        'amount_pen',
        'amount_acu',
        'start_date',
        'end_date',
        'contract_id',
        'client_id',
        'factory_plant_id',
        'created_by',
        'updated_by',
    ];
}
