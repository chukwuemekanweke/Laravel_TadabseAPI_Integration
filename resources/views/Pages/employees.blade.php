@extends('pages.main')
@section('title', 'Employee Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    
        @include('flash-message')

    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
        <span><strong>Response type: </strong> <span class="mark">{{ $response_type }}</span> </span>
        <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#employeeformmodal">Add New</a>
    </p>
    <p><span> <strong>Total Record(s):</strong></span> <span class="mark">{{ $total_items }}</span></p>
    <table class="table table-bordered table-striped table-hover mt-4" id="employee_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_51</th>
            <th scope="col">field_53</th>
            <th scope="col">field_54</th>
            <th scope="col">field_55</th>
            <th scope="col">field_52</th>
            <th scope="col">field_56</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
           @if (count($entity_records) > 0)
              @foreach ($entity_records as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_51 }}</td>
                    <td>{{ $record->field_53 }}</td>
                    <td>
                        @if($record->field_54 != '')
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <img src="{{ $record->field_54->src }}" alt="na"  class="w-100 rounded">
                                </li>
                                <li class="list-group-item">{{ 'width: ' . $record->field_54->width }}</li>
                                <li class="list-group-item">{{ 'height: ' . $record->field_54->height }}</li>
                                <li class="list-group-item">{{ 'public_id: ' .  $record->field_54->public_id }}</li>
                            </ul>
                            @else 
                            <li class="list-group-item">{{ 'n/a' }}</li>
                        @endif
                    </td>
                    <td>{{ ($record->field_55 != '') ? $record->field_55 : '-' }}</td>
                    <td>
                        <ul class="list-group">
                            @if ($record->field_52->address)
                                <li class="list-group-item">{{'Address: ' . $record->field_52->address }}</li>
                            @endif

                                @if ($record->field_52->address2)
                                <li class="list-group-item">{{'Address2: ' . $record->field_52->address2 }}</li>
                                @endif

                                @if ( $record->field_52->city)
                                <li class="list-group-item">{{'City: ' . $record->field_52->city }}</li>
                                @endif

                                @if ($record->field_52->state)
                                <li class="list-group-item">{{'State: ' .  $record->field_52->state }}</li>
                                @endif

                                @if ($record->field_52->country)
                                <li class="list-group-item">{{'Country: ' .  $record->field_52->country }}</li>
                            @endif
                            @if ($record->field_52->zip)
                            <li class="list-group-item">{{'Zip: ' .  $record->field_52->zip }}</li>
                            @endif
                            @if ($record->field_52->lng)
                            <li class="list-group-item">{{'Longitude: ' .  $record->field_52->lng }}</li>
                            @endif
                            @if ($record->field_52->lat)
                            <li class="list-group-item">{{'Latitude: ' .  $record->field_52->lat }}</li>
                            @endif
                        </ul>
                    </td>
                    <td>
                        <ul class="list-group">
                           @if ($record->field_56->title)
                             <li class="list-group-item">{{'Title: ' . $record->field_56->title }}</li>
                           @endif

                            @if ($record->field_56->first_name)
                               <li class="list-group-item">{{'First Name: ' . $record->field_56->first_name }}</li>
                            @endif

                            @if ( $record->field_56->middle_name)
                              <li class="list-group-item">{{'Middle Name: ' . $record->field_56->middle_name }}</li>
                            @endif

                            @if ($record->field_56->last_name)
                              <li class="list-group-item">{{'Last Name: ' .  $record->field_56->last_name }}</li>
                            @endif
                        </ul>
                    </td>
                    <td>
                        {{-- <button class="btn btn-info"><i class="fa fa-pencil" data-toggle="modal" data-target="#employeeformmodalupdate"></i></button> --}}
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

      {{-- modal start --}}
      <!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="employeeformmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Employee Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('employee')}}" enctype="multipart/form-data" method="post">
            <div class="row form-group">
                <div class="col-md-5">
                    <p><img id="output" width="300" height="400" /><span class="required"><sup>*</sup></span></p>
                    <input type="file" class="form-control-file" name="img_upload" accept="image/*" name="image" id="file"  onchange="loadFile(event)">
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-4"><label for="title">Title <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <select name="title" class="form-control" required>
                                <option value="" selected>Choose</option>
                                <option value="Mr" selected>Mr.</option>
                                <option value="Miss" selected>Miss.</option>
                                <option value="Mrs" selected>Mrs.</option>
                                <option value="Dr" selected>Dr.</option>
                                <option value="Prof" selected>Prof.</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4"><label for="first_name">First Name <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4"><label for="middle_name">Middle Name: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4"><label for="last_name">Last Name <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4"><label for="dob">Date of Birth <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="date" name="dob" class="form-control" placeholder="mm/dd/yyyy" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4"><label for="email">Email <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="email" placeholder="me@domain.com" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4"><label for="employee_type">Employee Type <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <select name="employee_type" id="employee_type" class="form-control" required>
                                <option value="" selected>Choose</option>
                                <option value="Logistic Driver">Logistic Driver</option>
                                <option value="Sales Clerk">Sales Clerk</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row form-group mt-3">
                <div class="col-md-6">
                   <div class="row">
                        <div class="col-md-4">
                            <label for="address">Address <span class="required"><sup>*</sup></span>: </label>
                        </div>
                        <div class="colmd-8">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Address" required>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="address_two">Address 2: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="address_two" name="address_two" class="form-control pull-left" placeholder="Address 2">
                        </div>
                   </div>
                </div>
            </div>
            <div class="row form-group mt-3">
                <div class="col-md-6">
                   <div class="row">
                        <div class="col-md-4">
                            <label for="city">City <span class="required"><sup>*</sup></span>: </label>
                        </div>
                        <div class="colmd-8">
                            <input type="text" id="city" name="city" class="form-control" placeholder="City" required>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="state">State <span class="required"><sup>*</sup></span>: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="state" name="state" class="form-control pull-left" placeholder="State" required>
                        </div>
                   </div>
                </div>
            </div>
            <div class="row form-group mt-3">
                <div class="col-md-6">
                   <div class="row">
                        <div class="col-md-4">
                            <label for="country">Country <span class="required"><sup>*</sup></span>: </label>
                        </div>
                        <div class="colmd-8">
                            <input type="text" id="country" name="country" class="form-control" placeholder="Country" required>
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="zip">Zip <span class="required"><sup>*</sup></span>: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="zip" name="zip" class="form-control pull-left" placeholder="Zip" required>
                            @csrf
                        </div>
                   </div>
                </div>
            </div>
            <div class="row form-group mt-3">
                <div class="col-md-6">
                   <div class="row">
                        <div class="col-md-4">
                            <label for="country">Longitude: </label>
                        </div>
                        <div class="colmd-8">
                            <input type="text" id="lng" name="country" class="form-control" placeholder="longitude">
                        </div>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="zip">Latitude: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="lat" name="lat" class="form-control pull-left" placeholder="Latitude">
                            @csrf
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
      {{-- modal end --}}
      
      {{-- update modal --}}
      <div class="modal fade" id="employeeformmodalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalScrollableTitle">Employee Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('employee')}}" enctype="multipart/form-data" method="post">
                <div class="row form-group">
                    <div class="col-md-5">
                        <p><img id="output" width="300" height="400" /></p>
                        <input type="file" class="form-control-file" name="img_upload" accept="image/*" name="image" id="file"  onchange="loadFile(event)">
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4"><label for="title">Title: </label></div>
                            <div class="col-md-8">
                                <select name="title" class="form-control" name="title">
                                    <option value="" selected>Choose</option>
                                    <option value="Mr" selected>Mr.</option>
                                    <option value="Miss" selected>Miss.</option>
                                    <option value="Mrs" selected>Mrs.</option>
                                    <option value="Dr" selected>Dr.</option>
                                    <option value="Prof" selected>Prof.</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="first_name_update">First Name: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="middle_name_update">Middle Name: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="last_name_update">Last Name: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="dob_update">Date of Birth: </label></div>
                            <div class="col-md-8">
                                <input type="date" name="dob" class="form-control" placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="email_update">Email: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email" placeholder="me@domain.com">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="employee_type_update">Employee Type: </label></div>
                            <div class="col-md-8">
                                <select name="employee_type" id="employee_type_update" class="form-control">
                                    <option value="" selected>Choose</option>
                                    <option value="Logistic Driver">Logistic Driver</option>
                                    <option value="Sales Clerk">Sales Clerk</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row form-group mt-3">
                    <div class="col-md-6">
                       <div class="row">
                            <div class="col-md-4">
                                <label for="address_update">Address: </label>
                            </div>
                            <div class="colmd-8">
                                <input type="text" id="address_update" name="address" class="form-control" placeholder="Address">
                            </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="address_two_update">Address 2: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="address_two_update" name="address_two" class="form-control pull-left" placeholder="Address 2">
                            </div>
                       </div>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col-md-6">
                       <div class="row">
                            <div class="col-md-4">
                                <label for="city">City: </label>
                            </div>
                            <div class="colmd-8">
                                <input type="text" id="city_update" name="city" class="form-control" placeholder="City">
                            </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="state">State: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="state_update" name="state" class="form-control pull-left" placeholder="State">
                            </div>
                       </div>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col-md-6">
                       <div class="row">
                            <div class="col-md-4">
                                <label for="country">Country: </label>
                            </div>
                            <div class="colmd-8">
                                <input type="text" id="country_update" name="country" class="form-control" placeholder="Country">
                            </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="zip_update">Zip: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="zip_update" name="zip" class="form-control pull-left" placeholder="Zip">
                                @csrf
                            </div>
                       </div>
                    </div>
                </div>
                <div class="row form-group mt-3">
                    <div class="col-md-6">
                       <div class="row">
                            <div class="col-md-4">
                                <label for="country">Longitude: </label>
                            </div>
                            <div class="colmd-8">
                                <input type="text" id="lng_update" name="country" class="form-control" placeholder="longitude">
                            </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="zip_update">Latitude: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="lat_update" name="lat" class="form-control pull-left" placeholder="Latitude">
                                @csrf
                                @method('PUT')
                            </div>
                       </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col offset-1">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                    </div>
                   <div class="col">
                       <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                   </div>
                </div>
                
            </form>
            </div>
          </div>
        </div>
      </div>
      {{-- update modal end --}}
</div>
  @section('scripts')
  <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
  </script>
  <script>
      $(document).ready(function() {
        $('#employee_records').DataTable();
       
      });
  </script>
@endsection