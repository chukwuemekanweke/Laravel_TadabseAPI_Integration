<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientUtilHelper\TadabaseServices;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
            'dob' => ['required', 'date'],
            'ratings' => ['required'],
            'status' => ['required'],
            'acquisition_date' => ['required', 'date'],
            'title' => ['required'],
            'first_name' => ['required'],
            'middle_name' => ['nullable'],
            'last_name' => ['required'],
            'address' => ['required'],
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
            'lat' => ['nullable']
        ]);
        
        if($validatedData->fails()) {
           return back()->with('error','Please supply valid inputs');
        }



        $customer  = new class {};
        $customer->field_41 = $request->dob;
        $customer->field_42 = $request->ratings;
        
        $customer->field_61 = array($request->status);

        $customer->field_64 = $request->acquisition_date;

        $customer->field_39 = new class{};
        $customer->field_39->title = $request->title;
        $customer->field_39->first_name = $request->first_name;
        $customer->field_39->middle_name = $request->middle_name;
        $customer->field_39->last_name = $request->last_name;

        $customer->field_40 = new class{};
        $customer->field_40->address = $request->address;
        $customer->field_40->address2 = $request->address_two;
        $customer->field_40->city = $request->city;
        $customer->field_40->state = $request->state;
        $customer->field_40->country =  $request->country;
        $customer->field_40->zip = $request->zip;
        $customer->field_40->lng = $request->lng;
        $customer->field_40->lat = $request->lat;

        $table_id = 'lGArg7rmR6';

        $describe_table_response = $this->tadabaseServices->save_data($table_id, (array)$customer);
    
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
