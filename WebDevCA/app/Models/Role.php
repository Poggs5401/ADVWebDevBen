<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //This function allows the use of $roles->users which will return all users within that role
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_role');
    }
}
