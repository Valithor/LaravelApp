<?php

namespace App\Http\Controllers\OutsideApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Twitter;

class TwitterController extends Controller
{
    public function getTweet()
    {
        $data = Twitter::getStatusesLookup(['id'=>1185112420794191872, 'format' => 'deasdtailed']);
    	return $data;
    }
}
