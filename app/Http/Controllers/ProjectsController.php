<?php

namespace App\Http\Controllers;

use App\Location;
use App\SerpResult;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $key_array = DB::table('projects')->get();

        foreach ($key_array as $key) {
            $keyword = $key->keyword;
            echo $keyword . '<br>';
        };

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $search_key = $request->cuvant_cheie;

        /*$search_key=explode('\r\n', $search_key);*/
        $search_key=preg_split('/\r\n|[\r\n]/', $search_key);

        foreach ($search_key as $search_key_keyword){

            $search_urlProiect = $request->url_proiect;
            $search_engine = $request->se_name;
            $se_language = $request->se_language;
            //$loc_name_canonical=$request->se_location;
            $loc_name = $request->se_location;
            //$loc_name_canonical=Location::where('loc_name_canonical', 'LIKE', "%{$loc_name}%")->get();

            $se_id=DB::table('engines')->where('se_name', 'LIKE', $search_engine)->where('se_language', 'LIKE', $se_language)->pluck('se_id');

            $loc_id = DB::Table('locations')->select('loc_id')->where('loc_name','LIKE',  $loc_name)->where('loc_type', 'LIKE', 'City')
                ->pluck('loc_id');

            Project::create(['keyword' => $search_key_keyword, 'urlProiect' => $search_urlProiect, 'search_engine_name' => $search_engine, 'search_engine_id' => $se_id[0],
                'location_name' => $loc_name, 'location_id'=>$loc_id[0], 'search_engine_language' => $se_language]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function view_projects_results()
    {

        $url_s = DB::table('projects')->get();
$results_aaa=array();
        foreach ($url_s as $rezultate)  {
           // dd($rezultate);
            $rezultate_ok = $rezultate->urlProiect;

            $results = SerpResult::where('resultUrl', 'LIKE', "%{$rezultate_ok}%")->get();

        }
        $results_aaa[]=$results;
       // dd($results);
       /* $results = SerpResult::where('resultUrl', 'LIKE', "%{$rezultate_ok}%")->get();*/
/*dd($results);*/
        return view('project.projectsResults', compact('results'));
    }

    /*
        Variabila: $nume_variabila;
        Functie: nume_functie / numeFunctie
        Clasa: NumeClasa
        Coloana bd: nume_coloana*/


    public function set_project()
    {

        return view('project.set_project');

    }

}
