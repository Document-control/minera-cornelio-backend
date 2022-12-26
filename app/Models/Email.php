<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    const PERSONAL = 1;
    const CORPORATIVE = 2;

    protected $fillable = [
        'name',
        'type',
        'main',
        'created_by',
        'updated_by'
    ];

    public function company()
    {
        $this->belongsTo(Company::class);
    }
    public function person()
    {
        $this->belongsTo(Person::class);
    }
}
