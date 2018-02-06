<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AnalisisData\MyAnalisis;

class AnalisisDataArhoController extends Controller
{
    //
    public function indexHome()
    {
    	# code...
    	$list_arho = MyAnalisis::fetch_arho();

    	return view('pages.analisis_data_per_arho',[
    		'list_arho'=>$list_arho
    		]);
    }

    public function get_laporan_arho(Request $request)
    {
    	# code...
    	$arho = $request['arho'];

    	return view('pages.visualisasi_per_arho',[
    			'arho'=>$arho
    		]);
    }
}
