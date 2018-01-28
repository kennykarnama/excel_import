<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function indexHome()
    {
    	# code...
    	return view('pages.home',[]);
    }
}
