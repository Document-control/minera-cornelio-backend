<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'doc_number',
        'last_name',
        'client_id',
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
    public function kind_people()
    {
        return $this->belongsToMany(KindPerson::class, 'kind_pivot_people', 'person_id', 'kind_person_id');
    }
}
