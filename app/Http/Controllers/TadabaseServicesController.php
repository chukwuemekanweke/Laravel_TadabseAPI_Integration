<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HttpClientUtilHelper\TadabaseServices;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Validator;

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
        $data_table_response = $this->tadabaseServices->data_entities();
        $data_tables = $data_table_response->data_tables;
        $response_type = $data_table_response->type ?? 'N/A';
        $total_tables = $data_table_response->total_items ?? 0;

        return view('pages.data_tables', compact('data_tables', 'response_type', 'total_tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return schema fields
     */
    public function entity_description(Request $request)
    {
        if($request->id) {
            $describe_table_response = $this->tadabaseServices->entity_schema($request->id);
            $describe_table = $describe_table_response->fields;
            $response_type = $describe_table_response->type ?? 'N/A';
            $schema_name = $request->name;
            $schema_id = $request->id;

           return view('pages.schema', compact('describe_table', 'response_type', 'schema_name','schema_id'));
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
        $validatedData = Validator::make($request->all(), [
            'title' => ['required'],
            'first_name' => ['required', 'min:2', 'max:50'],
            'middle_name' => ['nullable'],
            'last_name' => ['required', 'min:2', 'max:50'],
            'dob' => ['required', 'date'],
            'email' => ['required', 'email'],
            'employee_type' => ['required'],
            'address' => ['required', 'min:2'],
            'address_two' => ['nullable'],
            'city' => ['required', 'min:2', 'max:50'],
            'state' => ['required', 'min:2', 'max:50'],
            'country' => ['required', 'min:2', 'max:50'],
            'zip' => ['required'],
            'img_upload' => ['image'],
            'lng' => ['nullable'],
            'lat' => ['nullable']
        ]);
        
        if($validatedData->fails()) {
           return back()->with('error','Please supply valid inputs');
        }

        $employee = new class{};
        $employee->field_51 = $request->dob;

        $employee->field_52 = new class{};
        $employee->field_52->address = $request->address;
        $employee->field_52->address2 = $request->address_two;
        $employee->field_52->city = $request->city;
        $employee->field_52->state = $request->state;
        $employee->field_52->country = $request->country;
        $employee->field_52->zip = $request->zip;
        $employee->field_52->lng = $request->lng;
        $employee->field_52->lat = $request->lat;
        

        $employee->field_53 = $request->email;
        
        
        $employee->field_54 = new class{};

        if($request->hasFile('img_upload')) {

            Cloudder::upload($request->img_upload);
            $cloudder_upload = Cloudder::getResult();

            $employee->field_54->src = $cloudder_upload["secure_url"];
            $employee->field_54->width =  $cloudder_upload["width"];
            $employee->field_54->height = $cloudder_upload["height"];
            $employee->field_54->public_id = $cloudder_upload["public_id"];

        }

        $employee->field_55 = $request->employee_type;
        
        $employee->field_56 = new class{};
        $employee->field_56->title = $request->title;
        $employee->field_56->first_name = $request->first_name;
        $employee->field_56->middle_name = $request->middle_name;
        $employee->field_56->last_name = $request->last_name;


        $table_id = 'q3kjZVj6Vb';

        $describe_table_response = $this->tadabaseServices->save_data($table_id, (array)$employee);
        

        return redirect()->route('schema_detail', ['id' => $table_id, 'name' => 'employees']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return view pages and object array
     */
    public function show(Request $request)
    {
        $schema_id = $request->id;

        if($request->id) {
            $data_response = $this->tadabaseServices->show_entity_records($request->id);
            $entity_records = $data_response->items ?? [];
            $response_type = $data_response->type ?? 'N/A';
            $total_items = $data_response->total_items;
            $schema_name = \strtolower($request->name);

            $display_page = '';

            switch($schema_name) {
                case "projects":
                    $display_page = 'projects';
                    break;
                case "orders":
                    $display_page = 'orders';
                    break;
                case "tasks":
                    $display_page = 'tasks';
                    break;
                case "jobs":
                    $display_page = 'jobs';
                    break;
                case "supplier":
                    $display_page = 'supplier';
                    break;
                case "customers":
                    $display_page = 'customer';
                    break;
                case "employees":
                    $display_page = 'employees';
                    break;
                case "product":
                    $display_page = 'product';
                    break;
                default:
                    return $this->index();
            }

            return view("pages.$display_page", compact('entity_records', 'schema_name', 'response_type', 'total_items', 'schema_id'));
        }
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
     * @param  string  $table_id
     * @param string $record_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $deleted = $this->tadabaseServices->delete_record($request->table_id, $request->record_id);

        return back()->with('success','Record deleted successfully');
    }
}
