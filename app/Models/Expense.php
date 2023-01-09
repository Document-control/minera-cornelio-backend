<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'type_id',
        'start_date',
        'end_date',
        'created_by',
        'updated_by',
    ];
}
