<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KindPerson extends Model
{
    use HasFactory;

    public function person()
    {
        return $this->hasOne(Person::class);
    }
}
