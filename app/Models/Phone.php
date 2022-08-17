<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    public function company()
    {
        $this->belongsTo(Company::class);
    }
    public function person()
    {
        $this->belongsTo(Person::class);
    }
}