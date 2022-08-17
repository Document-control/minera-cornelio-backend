<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function client()
    {
        $this->hasOne(Client::class);
    }
    public function emails()
    {
        $this->hasMany(Email::class);
    }
    public function phones()
    {
        $this->hasMany(Phone::class);
    }
}
