<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    protected $table = 'user_managements';

    protected $fillable = [
        'first_name',
        'last_name', 
        'department', 
        'epf',
        'telephone', 
        'address', 
        'email', 
        'password',
        'role',
        'status'
    ];
}
