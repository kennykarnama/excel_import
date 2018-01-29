<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AnalisisData\MyAnalisis;

class AnalisisDataController extends Controller
{
    //
    public function indexHome()
    {
    	# code...
    	$list_arho = MyAnalisis::fetch_arho();

    	$list_kecamatan = MyAnalisis::fetch_kecamatan();

    	return view('pages.analisis_data',[

    		'list_arho'=>$list_arho,
    		'list_kecamatan'=>$list_kecamatan
    		]);
    }

    public function get_laporan_per_arho(Request $request)
    {
    	# code...
    	$arho = $request['arho'];

    	$kecamatan = $request['kecamatan'];

    	$jumlah_saldo = MyAnalisis::hitung_jumlah_saldo($arho,$kecamatan);


    	$jumlah_saldo_bal_7 = MyAnalisis::hitung_jumlah_saldo_bal($arho,$kecamatan,7);

    	$jumlah_saldo_bal_30 = MyAnalisis::hitung_jumlah_saldo_bal($arho,$kecamatan,30);

    	$persen_bal7 = 0;

    	$persen_bal30 = 0;

    	if($jumlah_saldo > 0){
    			$persen_bal7 = ($jumlah_saldo - $jumlah_saldo_bal_7) / ($jumlah_saldo);

    				$persen_bal30 = ($jumlah_saldo - $jumlah_saldo_bal_30) / ($jumlah_saldo);
    	}

    

	


    	$laporan = array(
    		'nama_arho'=>$arho,
    		'nama_kecamatan'=>$kecamatan,
    		'jumlah_saldo'=>$jumlah_saldo,
    		'bal7'=>$jumlah_saldo_bal_7,
    		'persen_bal7'=>$persen_bal7,
    		'bal30'=>$jumlah_saldo_bal_30,
    		'persen_bal30'=>$persen_bal30
    		);

    return redirect()->back()->with('laporan', $laporan);
    }

    
}
