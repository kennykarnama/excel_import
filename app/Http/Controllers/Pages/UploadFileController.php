<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use Excel;
use Session;


class UploadFileController extends Controller
{
    //
    public function indexHome()
    {
    	# code...
    	
    	return view('pages.upload_file',[]);
    }

  //   public function import_excel()
  //   {
  //   	set_time_limit ( 0 );

  //   	ini_set('memory_limit', '-1');

    	
  //   	# code...
  //   	if(Input::hasFile('import_file')){

    		
		// 	$path = Input::file('import_file')->getRealPath();
		// 	$data = Excel::load($path, function($reader) {
				
		// 	})->get();

		// 	$line0 = $data[0];

		// 	$headers = $line0->keys();

		// 	$headers = $headers->all();

		// 	$prepared_data = array();
		// 	//$headers = $headers['items'];

		// 	if(!empty($data) && $data->count()){
		// 		foreach ($data as $key => $value) {

		// 			$tmp = array();

		// 			for($i=0; $i < count($headers); $i++){
						
		// 				$nama_kolom = $headers[$i];

		// 				$tmp[$nama_kolom] = $value->$nama_kolom;
		// 			}

		// 			array_push($prepared_data, $tmp);

		// 			//$insert[] = ['nama' => $value->nama, 'years' => $value->years];
		// 		}
		// 		if(!empty($prepared_data)){

		// 			//dd($prepared_data);
					
		// 			$status = $this->insert_data_to_db_one_by_one('report',$prepared_data);

		// 			if($status==1){
		// 				$message = "Data berhasil diimport";
		// 			}

		// 			else{
		// 				$message = "Data tidak berhasil diimport";
		// 			}


					 
					
		// 		}

		// 		else{
		// 			$message = "Terjadi error ";
		// 		}


		// 	}
		// }

		// Session::flash('pesan_import',$message);


		// return back();
  //   }

     public function import_excel()
    {
    	# code...

    		ini_set('memory_limit', '-1');

    		

			set_time_limit ( 0 );


    		if(Input::hasFile('import_file')){

    		
			$path = Input::file('import_file')->getRealPath();

			$prepared_data = array();

				
			
			DB::table('report')->truncate();

			DB::disableQueryLog();
		

			Excel::filter('chunk')->load($path)->chunk(1000, function($results)
			{

					
					$counter = 0;
					
						$prepared_data = array();

			        foreach ($results as $row) {
			        	# code...
			        	$headers = $row->keys()->all();

			        	//dd($headers);

			        	$tmp = array();

			        	for($i=0;$i<count($headers);$i++){
			        		
			        		$col_name = $headers[$i];



			        		$tmp[$col_name] = $row[$col_name];

			        	}


			        	//echo $row->date_byr."<br>";



			        	// $counter++;

			        	array_push($prepared_data, $tmp);

			        	


			        }

			        //echo $counter."<br>";

			        //dd($prepared_data);
			        DB::table('report')->insert($prepared_data);

			       	//echo count($prepared_data)."<br>";
			       // echo "sukses"."<br>";

			      
			});

			$message = "Data berhasil diimport";



		}

		else{
			$message = "Data kosong";
		}

		Session::flash('pesan_import',$message);

		return back();
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
