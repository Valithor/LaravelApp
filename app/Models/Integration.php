<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $fillable = ['user_id','site_name','link'];

    public static $integrationSites = ['youtube','twitch','twitter'];
    public static $integrationLinks = ['https://www.youtube.com/channel/','https://www.twitch.tv/','https://twitter.com/'];

    /**
     * Link mam swojego Klienta
     */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}