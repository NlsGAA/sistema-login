<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'id',
        'permission_name',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_permissions',
            'permissions_id',
            'user_id'
        );
    }
}
