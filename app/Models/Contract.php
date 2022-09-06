<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    const PENDIENTE = 1;
    const OBSERVADO = 2;
    const APROBADO = 3;
    const ENMARCHA = 4;
    const ANULADO = 5;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function ope_requi_ope_type()
    {
        return $this->belongsTo(OpeRequiOpeType::class);
    }
}
