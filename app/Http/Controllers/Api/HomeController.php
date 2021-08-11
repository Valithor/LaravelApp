<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;




class HomeController extends Controller
{
    public function index()
    {   
        return view('home');
    }

    public function store()
    {   
        return view('layout');
    }
 
 
    
}