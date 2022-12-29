<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'main',
        'person_id',
        'client_id',
        'profile_id',
        'created_by',
        'updated_by'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
