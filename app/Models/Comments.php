<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['author','author_link','comment','profile_image'];
    public function randomizes()
    {
    	return $this->belongsTo('App\Models\Randomizes');
    }
}
