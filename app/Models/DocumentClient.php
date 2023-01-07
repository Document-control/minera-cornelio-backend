<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'description',
        'client_id',
        'document_id',
        'created_by',
        'updated_by',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
