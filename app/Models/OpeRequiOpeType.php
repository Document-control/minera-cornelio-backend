<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeRequiOpeType extends Model
{
    use HasFactory;

    const PENDIENTE = 1;
    const DESAPROBADO = 2;
    const APROBADO = 3;
    const ANULADO = 4;

    public function operation_type()
    {
        return $this->belongsTo(OperationType::class);
    }

    public function operation_requirement()
    {
        return $this->belongsTo(OperationRequirement::class);
    }

    public function document_requirement()
    {
        return $this->hasMany(DocumentRequirement::class);
    }
}
