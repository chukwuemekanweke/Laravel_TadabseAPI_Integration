<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientUtilHelper\TadabaseServices;

class TadabaseServicesController extends Controller
{
    protected $tadabaseServices;

    public function __construct(TadabaseServices $tadabaseServices)
    {
        $this->tadabaseServices = $tadabaseServices;
    }

    /**
     * Display a listing of $data_table_reponse.
     *
     * @return $data_table_reponse
     */
    public function index()
    {
        $data_table_reponse = $this->tadabaseServices->data_entities();
        $data_tables = $data_table_reponse->data_tables;
        $reponse_type = $data_table_reponse->type ?? 'N/A';
        $total_tables = $data_table_reponse->total_items;

        return view('pages.data_tables', compact('data_tables', 'reponse_type', 'total_tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entity_description(Request $request)
    {
        if($request->id) {
            $describe_table_reponse = $this->tadabaseServices->entity_schema($request->id);
            $describe_table = $describe_table_reponse->fields;
            $reponse_type = $describe_table_reponse->type ?? 'N/A';

           return view('pages.schema', compact('describe_table', 'reponse_type'));
        }
        
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
}
