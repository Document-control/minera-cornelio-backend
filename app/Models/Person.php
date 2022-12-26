<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'kind_person_id',
        'address_id',
        'created_by',
        'updated_by',
    ];

    public function client()
    {
        return $this->hasOne(Client::class);
    }
    public function emails()
    {
        return $this->hasMany(Email::class);
    }
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
    public function kind_person()
    {
        return $this->belongsTo(KindPerson::class);
    }
}
