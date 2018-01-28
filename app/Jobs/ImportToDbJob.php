<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use DB;
use Excel;

class ImportToDbJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $path;

    public $tries = 5;

    public function __construct($path)
    {
        //
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
            DB::table('report')->truncate();

        Excel::filter('chunk')->load($this->path)->chunk(250, function($results)
                {
                    

                    $prepared_data = array();

                    foreach($results as $row)
                        {
                            $headers = $row->keys()->all();

                            //dd($headers);

                            $tmp = array();

                            for($i = 0; $i < count($headers); $i++){
                                
                                $col_name = $headers[$i];

                                $tmp[$col_name] = $row[$col_name];



                            }

                            array_push($prepared_data, $tmp);

                        }

                       DB::table('report')->insert($prepared_data);


                },false);
    }
}
