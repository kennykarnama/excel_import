<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use Session;
use App\Jobs\CobaInsert;
use App\Jobs\ImportToDbJob;
use Artisan;



class UploadFileController extends Controller
{
    //
    public function indexHome()
    {
    	# code...
    	
    	return view('pages.upload_file',[]);
    }

 
    public function import_excel()
    {
    	# code...
    	if(Input::hasFile('import_file')){

    		$file = Input::file('import_file');

    		$file_name = $file->getClientOriginalName();

    		Input::file('import_file')->move('tet',$file_name);

    		$path = public_path()."/tet/".$file_name;


    		dispatch(new ImportToDbJob($path));

    		$message = "Data sedang diimport";

            // Artisan::call('queue:work',['--timeout'=>0]);

    		Session::flash('pesan_import',$message);

    		return back();

    	

    	
    	}


    }

    public function check_status(Request $request)
    {
        # code...
        $jumlah_queue = DB::table('jobs')->count();

        $jumlah_data_skrng = DB::table('report')->count();

        $data = array(
            'jumlah_queue'=>$jumlah_queue,
            'jumlah_data_skrng'=>$jumlah_data_skrng
            );
        return response()->json($data);
    }
  

    private  function insert_data_to_db_one_by_one($table_name,$data)
    {
    	# code...
    	

    		DB::beginTransaction();



		try {
		   
		   	DB::table($table_name)->truncate();

		   for($i = 0; $i < count($data); $i++){
		   		DB::table($table_name)->insert($data[$i]);


		   }

		    DB::commit();

		    return 1;
		    // all good
			} catch (\Exception $e) {
		    DB::rollback();

		    dd($e);

		    return 0;
		    
		    // something went wrong
			}
    	
    }

}
