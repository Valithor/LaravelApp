<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['type', 'data', 'winner', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
