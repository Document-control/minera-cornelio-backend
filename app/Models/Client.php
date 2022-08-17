<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    const NATURAL = 1;
    const COMPANY = 2;

    const ANULADO = 1;
    const VIGENTE = 2;
    const PENDIENTE = 3;
    const INACTIVO = 4;

    public function person()
    {
        $this->belongsTo(Person::class);
    }
    public function company()
    {
        $this->belongsTo(Company::class);
    }
    public function business_type()
    {
        $this->belongsTo(BusinessType::class);
    }
}
