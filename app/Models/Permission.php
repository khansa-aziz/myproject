<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
    ];

    public function adminPermissions()
    {
        return $this->hasMany(AdminPermission::class);
    }
}