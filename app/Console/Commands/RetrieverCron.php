<?php

namespace App\Console\Commands;

use App\SerpResult;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RestClient;
use RestClientException;

class RetrieverCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retriever:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function ceva(){

    }

    public function handle()
    {
        //SCOTI DIN BD
        $jobs=DB::table('taskjobs')->get();
        $task_ids=array();
        foreach ($jobs as $job){
            $job_tasks=$job->taskId;

            $task_ids[]=$job_tasks;

        }


        require('/var/www/myproject/myproject/resources/files/RestClient.php');
        $api_url = 'https://api.dataforseo.com/';
        try {
            //Instead of 'login' and 'password' use your credentials from https://my.dataforseo.com/
            $client = new RestClient($api_url, null, 'revenco_andrei@yahoo.com', 'FlMtt4RWJK7697VU');
        } catch (RestClientException $e) {
            echo "\n";
            print "HTTP code: {$e->getHttpCode()}\n";
            print "Error code: {$e->getCode()}\n";
            print  $e->getTraceAsString();
            echo "\n";
            exit();
        }

        foreach($task_ids as $task_id):
            $serp_result = $client->get('v2/srp_tasks_get/' . $task_id);

               $results=$serp_result['results']['organic']/*['0']['result_url']*/;

               foreach ($results as $result){
                   /*echo '<pre>';
                   print_r($result['result_url']);
                   echo  '</pre>';*/

               /*    DB::table('serp_results')->insert('')*/

                   SerpResult::create(['resultPostId'=>$result['post_id'], 'resultTaskId'=>$result['task_id'], 'resultSeId'=>$result['se_id'], 'resultLocationId'=>$result['loc_id'], 'resultPostKey'=>$result['post_key'], 'resultDatetime'=>$result['result_datetime'], 'resultPosition'=>$result['result_position'], 'resultUrl'=>$result['result_url']]);

               }

        //SerpResult::create(['resultPostId'=>$serp_result[]])
        endforeach;

/*
        'resultPostKey',
        'resultTaskId',
        'resultSeId',
        'resultLocationId',
        'resultKeyId'*/


    }
}
