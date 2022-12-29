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

    public function client()
    {
        $this->belongsTo(Client::class);
    }
    
    public function person()
    {
        $this->belongsTo(Person::class);
    }

    public function profile()
    {
        $this->belongsTo(Profile::class);
    }

}
