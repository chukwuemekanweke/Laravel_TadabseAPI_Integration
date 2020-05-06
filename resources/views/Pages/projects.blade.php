@extends('pages.main')
@section('title', 'Project Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
  @include('flash-message')
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
        <span><strong>Response type: </strong> <span class="mark">{{ $response_type }}</span></span> 
        <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#projectModal">Add New</a>
    </p>
    <p><span> <strong>Total Record(s):</strong></span> <span class="mark">{{ $total_items }}</span></p>
    <table class="table table-bordered table-striped table-hover mt-4" id="schema_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_47</th>
            <th scope="col">field_48</th>
            <th scope="col">field_49</th>
            <th scope="col">field_50</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
           @if (count($entity_records) > 0)
              @foreach ($entity_records as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_47 }}</td>
                    <td>{{ $record->field_48 }}</td>
                    <td>
                      <div class="accordion" id="{{'accordion'.$record->id}}">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="{{'#collapse' . $record->id }}" aria-expanded="true" aria-controls="collapseOne">
                                CLick to view 
                              </button>
                            </h2>
                          </div>
                      
                          <div id="{{'collapse' . $record->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="{{'#accordion'.$record->id}}">
                            <div class="card-body">
                              <ul class="list-group">
                                  <li class="list-group-item">Address: {{ ($record->field_49->address != '') ? $record->field_49->address : 'N/A' }}</li>
                                  <li class="list-group-item">Address2: {{ ($record->field_49->address2 != '') ? $record->field_49->address2 : 'N/A' }}</li>
                                  <li class="list-group-item">City: {{ ($record->field_49->city != '') ? $record->field_49->city : 'N/A'}}</li>
                                  <li class="list-group-item">State: {{ ($record->field_49->state != '') ? $record->field_49->state : 'N/A' }}</li>
                                  <li class="list-group-item">Country: {{ ($record->field_49->country != '') ? $record->field_49->country : 'N/A' }}</li>
                                  <li class="list-group-item">Zip: {{ ($record->field_49->zip != '') ? $record->field_49->zip : 'N/A'}}</li>
                                  <li class="list-group-item">Longitude: {{ ($record->field_49->lng != '') ? $record->field_49->lng : 'N/A' }}</li>
                                  <li class="list-group-item">Latitude: {{ ($record->field_49->lat != '') ? $record->field_49->lat : 'N/A'}}</li>
                                </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <ul class="list-group">
                        <li class="list-group-item">Start: {{ $record->field_50->start }}</li>
                        <li class="list-group-item">End: {{ $record->field_50->end }}</li>
                        <li class="list-group-item">All Day: {{ $record->field_50->all_day }}</li>
                      </ul>
                    </td>
                      <td>
                        <form action="/delete_record" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" name="table_id" value="{{ $schema_id }}">
                            <input type="hidden" name="record_id" value="{{ $record->id }}">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
              @endforeach
           @else
           <tr>
                <td colspan="3" class="text-center">No table(s) available..</td>
            </tr>
           @endif
        </tbody>
      </table>

      {{-- modal --}}
      <!-- Modal -->
      <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Project Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('project')}}" enctype="multipart/form-data" method="post">
                <div class="row form-group">
                    <div class="col-md-6">
                      <div class="row">
                          <div class="col-md-4"><label for="proj_name">Title <span class="required"><sup>*</sup></span> : </label></div>
                          <div class="col-md-8">
                            <input type="text" name="proj_name" class="form-control" placeholder="Name of project" required>
                            @csrf
                          </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="address_one">Address <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="address" placeholder="Address" required>
                        </div>
                    </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="country">Country <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="country" placeholder="Country" required>
                        </div>
                    </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="city">City <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="city" placeholder="City" required>
                        </div>
                    </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="lng">Longitude: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Longitude" name="lng">
                        </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-4"><label for="lat">Start Date <span class="required"><sup>*</sup></span>: </label></div>
                      <div class="col-md-8">
                          <input type="datetime-local" class="form-control" placeholder="dd/mm/yyyy" name="start_date" required>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4"><label for="created_on">Created On <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="date" name="created_on" class="form-control" required>
                        </div>
                      </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="middle_name">Address 2: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="address_two" placeholder="Address 2">
                            </div>
                        </div>
                       
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="state">State <span class="required"><sup>*</sup></span>: </label></div>
                            <div class="col-md-8">
                                <input type="text" name="state" class="form-control" placeholder="State" required>
                            </div>
                        </div>
                       
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="zip">Zip <span class="required"><sup>*</sup></span>: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Zip" name="zip" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-4"><label for="lat">Latitude: </label></div>
                          <div class="col-md-8">
                              <input type="text" class="form-control" placeholder="Latitude" name="lat">
                          </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="lat">Completion Date <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="datetime-local" class="form-control" placeholder="dd/mm/yyyy" name="end_date" required>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col offset-1">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                    </div>
                   <div class="col">
                       <button type="submit" class="btn btn-success btn-block">Save</button>
                   </div>
                </div>
                
            </form>
            </div>
          </div>
        </div>
      </div>

      {{-- ./modal --}}


</div>
  @section('scripts')
  <script>
      $(document).ready(function() {
        $('#schema_records').DataTable();
      });
  </script>
@endsection