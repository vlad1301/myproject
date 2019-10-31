<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        $task_ids = array("12092919356", "12092919361", "12092919364");

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
            echo "<pre>";
                print_r($serp_result);
            echo "</pre>";
        endforeach;


    }
}
