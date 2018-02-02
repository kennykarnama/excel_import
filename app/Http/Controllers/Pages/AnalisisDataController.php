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

    	$xls_kecamatan = MyAnalisis::fetch_kecamatan_from_xls();

        $list_kecamatan = MyAnalisis::fetch_kecamatan();

        $final_list_kecamatan = array();

        foreach ($xls_kecamatan as $xls) {
            # code...

            foreach ($list_kecamatan as $kecamatan) {
                # code...
                $str = strtoupper($kecamatan->nama_kecamatan);

                if($xls->KECAMATAN == $str){
                    array_push($final_list_kecamatan, $kecamatan);
                }
            }
        }
    	return view('pages.analisis_data',[

    		'list_arho'=>$list_arho,
    		'list_kecamatan'=>$final_list_kecamatan
    		]);
    }

    public function get_laporan_kecamatan(Request $request)
    {
        # code...
        $xls_kecamatan = MyAnalisis::fetch_kecamatan_from_xls();

        $list_kecamatan = MyAnalisis::fetch_kecamatan();

        $final_list_kecamatan = array();

        foreach ($xls_kecamatan as $xls) {
            # code...

            foreach ($list_kecamatan as $kecamatan) {
                # code...
                // $str = strtoupper($kecamatan->nama_kecamatan);



                if($xls->KECAMATAN == $kecamatan->nama_kecamatan){
                    array_push($final_list_kecamatan, $kecamatan);
                }
            }
        }

        return response()->json($final_list_kecamatan);
    }

    public function detail_laporan_kecamatan($kecamatan)
    {
        # code...
        $kecamatan = strtoupper($kecamatan);

        $list_arho = MyAnalisis::fetch_arho_by_kecamatan($kecamatan);

       

        return view('pages.analisis_data_kecamatan',[

            'list_arho'=>$list_arho,
            'kecamatan'=>$kecamatan

           
            ]);

        //dd($list_arho);
    }

    public function detail_laporan_arho(Request $request)
    {
        # code...
        $kecamatan = $request['kecamatan'];

        $arho = $request['arho'];
        
        $list_kelurahan = MyAnalisis::fetch_kelurahan($kecamatan);

        //dd($list_kelurahan);

        $detail_laporan = array();

        foreach ($list_kelurahan as $kelurahan) {
            # code...

            $jumlah_saldo = MyAnalisis::hitung_jumlah_saldo_kelurahan($arho,$kelurahan->KELURAHAN);


            $jumlah_saldo_bal_7 = MyAnalisis::hitung_jumlah_saldo_bal_kelurahan($arho,$kelurahan->KELURAHAN,7);

            $jumlah_saldo_bal_30 = MyAnalisis::hitung_jumlah_saldo_bal_kelurahan($arho,$kelurahan->KELURAHAN,30);

            $persen_bal7 = 0;

            $persen_bal30 = 0;

            if($jumlah_saldo > 0){
                    $persen_bal7 = ($jumlah_saldo - $jumlah_saldo_bal_7) / ($jumlah_saldo);

                        $persen_bal30 = ($jumlah_saldo - $jumlah_saldo_bal_30) / ($jumlah_saldo);
            }

            $tmp = array(
                'nama_kelurahan'=>$kelurahan->KELURAHAN,
                'jumlah_saldo'=>$jumlah_saldo,
                'bal7'=>$jumlah_saldo_bal_7,
                'persen_bal7'=>$persen_bal7,
                'bal30'=>$jumlah_saldo_bal_30,
                'persen_bal30'=>$persen_bal30
                );

            if(MyAnalisis::is_valid_wilayah($jumlah_saldo)){
               array_push($detail_laporan, $tmp);
            }

        }

        //dd($detail_laporan);
        
        return view('pages.analisis_data_detail_arho',[
            'arho'=>$arho,
            'kecamatan'=>$kecamatan,
            'detail_laporan'=>$detail_laporan
            ]);

    }

    // public function detail_laporan_arho($arho,$kecamatan)
    // {
    //     # code...

    //     $list_kelurahan = MyAnalisis::fetch_kelurahan($kecamatan);

    //     //dd($list_kelurahan);

    //     $detail_laporan = array();

    //     foreach ($list_kelurahan as $kelurahan) {
    //         # code...

    //         $jumlah_saldo = MyAnalisis::hitung_jumlah_saldo_kelurahan($arho,$kelurahan->KELURAHAN);


    //         $jumlah_saldo_bal_7 = MyAnalisis::hitung_jumlah_saldo_bal_kelurahan($arho,$kelurahan->KELURAHAN,7);

    //         $jumlah_saldo_bal_30 = MyAnalisis::hitung_jumlah_saldo_bal_kelurahan($arho,$kelurahan->KELURAHAN,30);

    //         $persen_bal7 = 0;

    //         $persen_bal30 = 0;

    //         if($jumlah_saldo > 0){
    //                 $persen_bal7 = ($jumlah_saldo - $jumlah_saldo_bal_7) / ($jumlah_saldo);

    //                     $persen_bal30 = ($jumlah_saldo - $jumlah_saldo_bal_30) / ($jumlah_saldo);
    //         }

    //         $tmp = array(
    //             'nama_kelurahan'=>$kelurahan->KELURAHAN,
    //             'jumlah_saldo'=>$jumlah_saldo,
    //             'bal7'=>$jumlah_saldo_bal_7,
    //             'persen_bal7'=>$persen_bal7,
    //             'bal30'=>$jumlah_saldo_bal_30,
    //             'persen_bal30'=>$persen_bal30
    //             );

    //         if(MyAnalisis::is_valid_wilayah($jumlah_saldo)){
    //            array_push($detail_laporan, $tmp);
    //         }

    //     }

    //     //dd($detail_laporan);
        
    //     return view('pages.analisis_data_detail_arho',[
    //         'arho'=>$arho,
    //         'kecamatan'=>$kecamatan,
    //         'detail_laporan'=>$detail_laporan
    //         ]);
    // }

    public function index_laporan_kecamatan()
    {
        # code...
        $list_arho = MyAnalisis::fetch_arho();

        $list_kecamatan = MyAnalisis::fetch_kecamatan();

        return view('pages.analisis_data_kecamatan',[

            'list_arho'=>$list_arho,
            'list_kecamatan'=>$list_kecamatan
            ]);
    }

    public function get_laporan_arho(Request $request)
    {
        # code...
        $arho = $request['arho'];

        $list_kecamatan = MyAnalisis::fetch_kecamatan();

        $laporan = array();

        $laporan[0] = $arho;

        $puter = 1;

        foreach ($list_kecamatan as $kecamatan) {
            # code...
            

            $jumlah_saldo = MyAnalisis::hitung_jumlah_saldo($arho,$kecamatan->nama_kecamatan);


            $jumlah_saldo_bal_7 = MyAnalisis::hitung_jumlah_saldo_bal($arho,$kecamatan->nama_kecamatan,7);

            $jumlah_saldo_bal_30 = MyAnalisis::hitung_jumlah_saldo_bal($arho,$kecamatan->nama_kecamatan,30);

            $persen_bal7 = 0;

            $persen_bal30 = 0;

            if($jumlah_saldo > 0){
                    $persen_bal7 = ($jumlah_saldo - $jumlah_saldo_bal_7) / ($jumlah_saldo);

                        $persen_bal30 = ($jumlah_saldo - $jumlah_saldo_bal_30) / ($jumlah_saldo);
            }

            $tmp = array(
                'nama_kecamatan'=>$kecamatan->nama_kecamatan,
                'jumlah_saldo'=>$jumlah_saldo,
                'bal7'=>$jumlah_saldo_bal_7,
                'persen_bal7'=>$persen_bal7,
                'bal30'=>$jumlah_saldo_bal_30,
                'persen_bal30'=>$persen_bal30
                );

            if(MyAnalisis::is_valid_wilayah($jumlah_saldo)){
               array_push($laporan, $tmp);
            }
           

        }

        return redirect()->back()->with('laporan', $laporan);
        
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
