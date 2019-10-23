<?php

namespace App\Http\Controllers;

use App\Engine;
use App\LiveSerp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RestClient;
use RestClientException;


class LiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_results=LiveSerp::all();
        return view('live.all_results', compact('all_results'));
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
        $search_key=$request->cuvant_cheie;
        $search_engine=$request->se_name;
        $se_language=$request->se_language;
        //$loc_name_canonical=$request->locatie;
        $loc_name_canonical='Bucharest,Romania';
        //$url=$request->domeniu;

        require('C:\xampp\htdocs\myproject\resources\files\RestClient.php');
//You can download this file from here https://api.dataforseo.com/_examples/php/_php_RestClient.zip

        try {
            //Instead of 'login' and 'password' use your credentials from https://my.dataforseo.com/login
            $client = new RestClient('https://api.dataforseo.com/', null, 'revenco_andrei@yahoo.com', 'FlMtt4RWJK7697VU');
        } catch (RestClientException $e) {
            echo "\n";
            print "HTTP code: {$e->getHttpCode()}\n";
            print "Error code: {$e->getCode()}\n";
            print "Message: {$e->getMessage()}\n";
            print  $e->getTraceAsString();
            echo "\n";
            exit();
        }

        $post_array = array();




        $my_unq_id = mt_rand(0, 30000000); //your unique ID. we will return it with all results. you can set your database ID, string, etc.
        $post_array[$my_unq_id] = array(
            "se_name" => $search_engine,
            "se_language" => $se_language,
            "loc_name_canonical"=> $loc_name_canonical,
            "key" =>  mb_convert_encoding($search_key, "UTF-8"),
            //"url"=>$url
        );

        try {
            // POST /v2/live/srp_tasks_post/$data
            // $tasks_data must by array with key 'data'
            $result = $client->post('v2/live/srp_tasks_post', array('data' => $post_array));
            //print_r($result);

            //$result_organic=$result['results']['organic'];
            $result_body=$result['results']['paid'];
            //$body=$result['results']/*['organic']*/;

           /*dd($result_body);*/

            $temp_data = array();
            $inc = 0;
            foreach($result_body as $result):
                $temp_data[$inc] = $result;
                $se_id_temp = Engine::where('se_id', $result['se_id'])->first();

                $temp_data[$inc]['engine_name'] = $se_id_temp->se_name;
                $temp_data[$inc]['location_name'] = $se_id_temp->se_country_name;

                $inc += 1;
            endforeach;
            $result_body = $temp_data;

            foreach ($result_body as $results){
                //LiveSerp::create(['keyword'=>$results['post_key'], 'URL'=>$results['result_url']]);

                LiveSerp::create(['data_interogare'=>$results['result_datetime'],'keyword'=>$results['post_key'],'URL'=>$results['result_url'],'locatia'=>$results['loc_id'],'se_id'=>$results['se_id'],
                    'engine_name'=>$results['engine_name'],'country'=>$results['location_name']]);
               //echo $results['result_url'];
                //$engine=Engine::find($results['se_id']);

            }


            //do something with post results

            $post_array = array();

             //return redirect('C:\xampp\htdocs\myproject\resources\views\live\current_results.blade.php');


           // dd($result_body);

            return view('live.current_results', compact('result_body'));//["NumeVariabilaView" => $variabila, ]

             //return view('C:\xampp\htdocs\myproject\resources\views\live\search.blade.php');
            //return redirect()->back();

        } catch (RestClientException $e) {
            echo "\n";
            print "HTTP code: {$e->getHttpCode()}\n";
            print "Error code: {$e->getCode()}\n";
            print "Message: {$e->getMessage()}\n";
            print  $e->getTraceAsString();
            echo "\n";
        }

        $client = null;


    }

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

    public function search(){

    return view('live.search');

    }

    public function search_engine(Request $request)
        {
            if($request->get('query'))
            {
                $query = $request->get('query');
                $data = DB::table('engines')
                    ->where('se_name', 'LIKE', "%{$query}%")
                    ->get();
                $output1 = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                    $output1 .= '
       <li><a href="#">'.$row->se_name.'</a></li>
       ';
                }
                $output1 .= '</ul>';
                echo $output1;
            }
        }


    public function search_language(Request $request)
{
    if($request->get('query'))
    {
        $query = $request->get('query');
        $data = DB::table('engines')
            ->where('se_language', 'LIKE', "%{$query}%")
            ->get();
        $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
        foreach($data as $row)
        {
            $output .= '
       <li><a href="#">'.$row->se_language.'</a></li>
       ';
        }
        $output .= '</ul>';
        echo $output;
    }
}


    public function all_results(){
        $all_results=LiveSerp::all();
        //$loca = Student::with('grade')->get();
        return view('live.all_results', compact('all_results'));
    }

}
