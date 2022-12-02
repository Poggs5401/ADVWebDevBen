<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address'];

    // returns the publisher's books
    // eg. $publisher->books
    public function games()
    {
        return $this->hasMany(Game::class);
    }
}