<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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


        $key_array = array("caiet", "seo url", "ceva");
        $se_id = "270";
        $loc_id = "1011795";
        //SCOTI DIN BD

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

        $post_array = array();

        foreach($key_array as $keyword):

            $post_array[] = array(
                "se_id" => $se_id,
                "loc_id" => $loc_id,
                "key" => mb_convert_encoding($keyword, "UTF-8")
            );

        endforeach;

        if (count($post_array) > 0) {
            try {
                // POST /v2/srp_tasks_post/$tasks_data
                // $tasks_data must by array with key 'data'
                $task_post_result = $client->post('/v2/srp_tasks_post', array('data' => $post_array));
                print_r($task_post_result);

                //INSEREI IN BD

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
