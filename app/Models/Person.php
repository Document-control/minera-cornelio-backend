<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    const OWNER = 1;
    const CONTACT = 2;
    const LEGAL_REPRESENTATIVE = 3;

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
    public function kind_person()
    {
        $this->belongsTo(KindPerson::class);
    }
}
