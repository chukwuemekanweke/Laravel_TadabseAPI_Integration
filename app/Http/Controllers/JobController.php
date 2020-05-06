<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientUtilHelper\TadabaseServices;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    protected $tadabaseServices;

    public function __construct(TadabaseServices $tadabaseServices)
    {
        $this->tadabaseServices = $tadabaseServices;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => ['required', 'min:2']
        ]);
        
        if($validatedData->fails()) {
           return back()->with('error','Please supply valid inputs');
        }

        $jobs = new class{};
        $jobs->field_38 = $request->name;

        $table_id = 'K2ejlOQo9B';

        $describe_table_response = $this->tadabaseServices->save_data($table_id, (array)$jobs);
        
        if(\strtolower($describe_table_response->type) == 'success') {
           
            return back()->with('success','New record added successfully');

        }

        return back()->with('error','Oops!, Something went wrong');

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

}
