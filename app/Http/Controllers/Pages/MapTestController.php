<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapTestController extends Controller
{
    //

    public function indexHome()
    {
    	# code...
    	return view('pages.map_test');
    }
}
