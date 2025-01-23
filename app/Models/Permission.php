<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['controller_name', 'method_name'];

    public function groups() {
        return $this->belongsToMany(Group::class, 'group_permissions');
    }
}
