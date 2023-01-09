<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailExpCourier extends Model
{
    use HasFactory;

    protected $fillable = [
        'plates',
        'weight',
        'total',
        'currency',
        'expense_id',
        'courier_id',
        'created_by',
        'updated_by',
    ];
}
