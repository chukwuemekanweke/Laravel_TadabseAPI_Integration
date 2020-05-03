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
        $data_table_response = $this->tadabaseServices->data_entities();
        $data_tables = $data_table_response->data_tables;
        $response_type = $data_table_response->type ?? 'N/A';
        $total_tables = $data_table_response->total_items;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return view pages and object array
     */
    public function show(Request $request)
    {
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

            return view("pages.$display_page", compact('entity_records', 'schema_name', 'response_type', 'total_items'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
