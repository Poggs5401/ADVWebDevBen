<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    public function games()
    {
    return $this->belongstoMany(Game::class)->withTimestamps();
    }
}
