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

    public function get_maps_arho(Request $request)
    {
        # code...
        $arho = $request['arho'];

        $list_kecamatan_by_arho = MyAnalisis::fetch_kecamatan_by_arho($arho);

        $final_list_kecamatan = array();

        $list_kecamatan = MyAnalisis::fetch_kecamatan();

        foreach ($list_kecamatan as $kecamatan) {
            # code...
            foreach ($list_kecamatan_by_arho as $kecamatan_arho) {
                # code...
                if($kecamatan_arho->KECAMATAN == $kecamatan->nama_kecamatan){
                    array_push($final_list_kecamatan, $kecamatan);
                    break;
                }
            }
        }

        return response()->json($final_list_kecamatan);

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
