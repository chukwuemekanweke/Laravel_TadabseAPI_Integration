<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientUtilHelper\TadabaseServices;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
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
        $task = new class{};
        $task->field_57 = $request->name;
        $task->field_58 = $request->description;
        $task->field_59 = $request->due_date;

        $task->field_60 = [''];

        $table_id = 'JDXQ80QYRl';

        $describe_table_response = $this->tadabaseServices->save_data($table_id, (array)$task);
    
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
