<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientUtilHelper\TadabaseServices;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
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
            'proj_name' => ['required'],
            'created_on' => ['required', 'date'],
            'address_one' => ['required'],
            'address_two' => ['nullable'],
            'city' => ['required'],
            'state' => ['required'],
            'address' => ['required', 'min:2'],
            'address_two' => ['nullable'],
            'city' => ['required', 'min:2', 'max:50'],
            'state' => ['required', 'min:2', 'max:50'],
            'country' => ['required'],
            'zip' => ['required'],
            'lng' => ['nullable'],
            'lat' => ['nullable'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);
        
        if($validatedData->fails()) {
           return back()->with('error','Please supply valid inputs');
        }



        $project = new class{};
        $project->field_47 = $request->proj_name;
        $project->field_48 = $request->created_on;
        
        $project->field_49 = new class{};
        $project->field_49->address = $request->address_one;
        $project->field_49->address2 = $request->address_two;
        $project->field_49->city = $request->city;
        $project->field_49->state = $request->state;
        $project->field_49->country = $request->country;
        $project->field_49->zip = $request->zip;
        $project->field_49->lng = $request->lng;
        $project->field_49->lat = $request->lat;
        
        $project->field_50 = new class{};
        $project->field_50->start = $request->start_date;
        $project->field_50->end = $request->end_date;

        $project->field_50->all_day = round((\strtotime($request->start_date) - \strtotime($request->end_date)) / (60 * 60 * 24));

        $table_id = '698rd2QZwd';
        $describe_table_response = $this->tadabaseServices->save_data($table_id, (array)$project);

    
        if(\strtolower($describe_table_response->type) == 'success') {
           
            return back()->with('success','New record added successfully');

        }

        return back()->with('error','Oops!, Something went wrong');

        
        

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
