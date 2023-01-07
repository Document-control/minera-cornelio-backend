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

    protected $with = [
        'emails',
        'phones',
        'addresses',
        'kind_people'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class, 'client_id');
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
