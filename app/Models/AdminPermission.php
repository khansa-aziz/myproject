<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $fillable = [
        'admin_id',
        'module',
        'permission',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}