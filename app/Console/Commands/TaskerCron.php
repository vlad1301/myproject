<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PhpMyAdmin\Dbi\DbiDummy;
use RestClient;
use RestClientException;

class TaskerCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasker:cron';

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
        require('/var/www/myproject/myproject/resources/files/RestClient.php');
        //SCOTI DIN BD

            $key_array=DB::table('tasks')->get();

            $post_array=array();

            foreach ($key_array as $key){
                //$task_id=$key->taskjobs;
                //DD($key->taskjobs);

                    $unique_id=$key->id;
                    $keyword=$key->keyword;

                    $urlProiect=$key->urlProiect;
                    $post_id=$unique_id . $urlProiect;

                    $search_engine_name=$key->search_engine_name;
                    $search_engine_language=$key->search_engine_language;
                    $location=$key->location_name;

                    $post_array[$post_id] = array(

                        "se_name" => $search_engine_name,
                        "se_language"=>$search_engine_language,
                        "loc_name_canonical" => $location,
                        "key" => mb_convert_encoding($keyword, "UTF-8")
                    );

                };




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

        /*$post_array = array();

        foreach($key_array as $keyword):

            $post_array[] = array(
                "se_id" => $se_id,
                "loc_id" => $loc_id,
                "key" => mb_convert_encoding($keyword, "UTF-8")
            );

        endforeach;*/

        if (count($post_array) > 0) {
            try {
                // POST /v2/srp_tasks_post/$tasks_data
                // $tasks_data must by array with key 'data'
                $task_post_result = $client->post('/v2/srp_tasks_post', array('data' => $post_array));

                /* echo "<pre>";
                print_r($task_post_result);
                echo "</pre>";*/

                $task_results=$task_post_result['results'];
                foreach ($task_results as $task){

                    /*echo $task['task_id'];*/
                    DB::table('taskjobs')->insert(['taskId'=>$task['task_id'], 'postId'=>$task['post_id'],'postKey'=>$task['post_key']]);
                }



                //INSEREZI IN BD

                //do something with post results

                $post_array = array();
            } catch (RestClientException $e) {
                echo "\n";
                print "HTTP code: {$e->getHttpCode()}\n";
                print "Error code: {$e->getCode()}\n";
                print "Message: {$e->getMessage()}\n";
                print  $e->getTraceAsString();
                echo "\n";
            }
        }
    }
}
