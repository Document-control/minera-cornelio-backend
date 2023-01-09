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
        'start_date',
        'end_date',
        'client_id',
        'document_id',
        'created_by',
        'updated_by',
    ];

    protected $appends = [
        'document_name'
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function photos()
    {
        return $this->hasMany(DocumentPhotoClient::class, 'doc_client_id');
    }

    public function getDocumentNameAttribute()
    {
        return Document::where('id', $this->document_id)->first()->name;
    }
}
