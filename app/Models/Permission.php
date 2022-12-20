<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permission_role()
    {
        return $this->hasMany(PermissionRole::class);
    }

    public function permission_user()
    {
        return $this->hasMany(PermissionUser::class);
    }
}
