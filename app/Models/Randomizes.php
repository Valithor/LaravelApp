<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Randomizes extends Model
{
    protected $fillable = ['name'];

    public function comments()
    {
        return $this->hasMany('App\Models\Comments');
    }
}
