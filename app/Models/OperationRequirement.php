<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationRequirement extends Model
{
    use HasFactory;

    public function ope_requi_ope_types()
    {
        return $this->hasMany(OpeRequiOpeType::class);
    }
}
