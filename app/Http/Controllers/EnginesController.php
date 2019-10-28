<?php

namespace App\Http\Controllers;

use App\Engine;
use Illuminate\Http\Request;
use RestClient;
use RestClientException;

class EnginesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_engines(){

        require('/var/www/myproject/myproject/resources/files/RestClient.php');
//You can download this file from here https://api.dataforseo.com/_examples/php/_php_RestClient.zip

        try {
            //Instead of 'login' and 'password' use your credentials from https://my.dataforseo.com/login
            $client = new RestClient('https://api.dataforseo.com/', null, 'revenco_andrei@yahoo.com', 'FlMtt4RWJK7697VU');

            $se_get_result = $client->get('v2/cmn_se');
            //print_r($se_get_result);

            $results_body=$se_get_result['results'];

            //print_r($results_body);
            foreach ($results_body as $results){
                //echo $results['se_localization'] . '</br>';

                if(isset($results['se_localization'])){
                     $se_localization=$results['se_localization'];
                }else{
                    $se_localization='not available';
                }


            Engine::create(['se_id'=>$results['se_id'], 'se_name'=>$results['se_name'] , 'se_country_iso_code'=>$results['se_country_iso_code'],
            'se_country_name'=>$results['se_country_name'], 'se_language'=>$results['se_language'], 'se_localization'=>$se_localization]);

            }
            //print_r($results_body);



            //do something with se

        } catch (RestClientException $e) {
            echo "\n";
            print "HTTP code: {$e->getHttpCode()}\n";
            print "Error code: {$e->getCode()}\n";
            print "Message: {$e->getMessage()}\n";
            print  $e->getTraceAsString();
            echo "\n";
            exit();
        }

        $client = null;

    }

}
