<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequirement extends Model
{
    use HasFactory;

    public function ope_requi_ope_type()
    {
        return $this->belongsTo(OpeRequiOpeType::class);
    }
}
