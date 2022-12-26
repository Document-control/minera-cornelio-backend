<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // protected $dateFormat = 'Y/m/d H:i:s';

    protected $fillable = ['name', 'created_by', 'updated_by'];

    public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d/m/Y');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d/m/Y');
    }

    public function getCreatedByAttribute()
    {
        return User::find($this->attributes['created_by'])->name;
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(mb_strtolower($value, 'UTF-8')),
            set: fn ($value) => mb_strtoupper(trim($value), 'UTF-8'),
        );
    }
}
