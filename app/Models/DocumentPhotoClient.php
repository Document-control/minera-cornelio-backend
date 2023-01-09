<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DocumentPhotoClient extends Model
{
    use HasFactory;

    public function document_client()
    {
        return $this->belongsTo(DocumentClient::class);
    }
}
