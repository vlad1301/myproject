<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use RestClient;
use RestClientException;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations=Location::all();
        return view('locations.index', compact('locations'));
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

    public function get_locations(){

        require('/var/www/myproject/myproject/resources/files/RestClient.php');
//You can download this file from here https://api.dataforseo.com/_examples/php/_php_RestClient.zip

        try {
            //Instead of 'login' and 'password' use your credentials from https://my.dataforseo.com/login
            //$client = new RestClient('https://api.dataforseo.com/', null, 'login', 'password');
            $client = new RestClient('https://api.dataforseo.com/', null, 'revenco_andrei@yahoo.com', 'FlMtt4RWJK7697VU');
            $loc_get_result = $client->get('v2/cmn_locations');
            //print_r($loc_get_result);

            $body=$loc_get_result['results'];
            foreach ($body as $results){

            Location::create(['loc_name'=>$results['loc_name'],'loc_id'=>$results['loc_id'], 'loc_id_parent'=>$results['loc_id_parent'], 'name'=>$results['loc_name'], 'loc_name_canonical'=>$results['loc_name_canonical'], 'loc_type'=>$results['loc_type'],'loc_country_iso_code'=>$results['loc_country_iso_code']]);
  }
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
