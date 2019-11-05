<?php

namespace App\Http\Controllers;

use App\SerpResult;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $key_array = DB::table('tasks')->get();

        foreach ($key_array as $key) {
          $keyword=$key->keyword;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $search_key=$request->cuvant_cheie;
        $search_urlProiect=$request->url_proiect;

        $search_engine=$request->se_name;
        $se_language=$request->se_language;
        //$loc_name_canonical=$request->se_location;
        $loc_name_canonical=$request->se_location;


        Task::create(['keyword'=>$search_key, 'urlProiect'=>$search_urlProiect, 'search_engine_name'=>$search_engine, 'location_name'=>$loc_name_canonical, 'search_engine_language'=>$se_language]);

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

    public function view_tasks_results(){
        //$results=SerpResult::where('resultUrl', 'https://www.fly-go.ro/' );
        $url_s=DB::table('tasks')->first();
        $url=$url_s->urlProiect;
        $results=SerpResult::where('resultUrl', 'LIKE', "%{$url}%")->get();

     /*   $results=DB::table('serp_results')->where('resultUrl', 'LIKE', "%{$url}%")->get();*/
        return view('taskuri.taskResults', compact('results'));
    }

    Variabila: $nume_variabila;
    Functie: nume_functie / numeFunctie
    Clasa: NumeClasa
    Coloana bd: nume_coloana

}
