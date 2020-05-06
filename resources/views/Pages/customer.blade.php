@extends('pages.main')
@section('title', 'Customer Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">

  @include('flash-message')
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
       <span> <strong> Response type:</strong> <span class="mark">{{ $response_type }}</span> </span>
        <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#customerModal">Add New</a>
    </p>
    <p><span> <strong>Total Record(s):</strong></span> <span class="mark">{{ $total_items }}</span></p>
    <table class="table table-bordered table-striped table-hover mt-4" id="customer_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_41</th>
            <th scope="col">field_42</th>
            <th scope="col">field_61</th>
            <th scope="col">field_62</th>
            <th scope="col">field_63</th>
            <th scope="col">field_64</th>
            <th scope="col">field_39</th>
            <th scope="col">field_40</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
           @if (count($entity_records) > 0)
              @foreach ($entity_records as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_41 }}</td>
                    <td>{{ $record->field_42 }}</td>
                    <td>
                        @if (count($record->field_61) > 0)
                            @foreach ($record->field_61 as $item)
                                {{ $item }}
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $record->field_62 }}</td>
                    <td>{{ $record->field_63 }}</td>
                    <td>{{ $record->field_64 }}</td>
                    <td>
                        <ul class="list-group">
                           @if ($record->field_39->title)
                             <li class="list-group-item">{{'Title: ' . $record->field_39->title }}</li>
                           @endif

                            @if ($record->field_39->first_name)
                               <li class="list-group-item">{{'First Name: ' . $record->field_39->first_name }}</li>
                            @endif

                            @if ( $record->field_39->middle_name)
                              <li class="list-group-item">{{'Middle Name: ' . $record->field_39->middle_name }}</li>
                            @endif

                            @if ($record->field_39->last_name)
                              <li class="list-group-item">{{'Last Name: ' .  $record->field_39->last_name }}</li>
                            @endif
                        </ul>

                    </td>
                    <td>
                        <ul class="list-group">
                            @if ($record->field_40->address)
                                <li class="list-group-item">{{'Address: ' . $record->field_40->address }}</li>
                            @endif

                                @if ($record->field_40->address2)
                                <li class="list-group-item">{{'Address2: ' . $record->field_40->address2 }}</li>
                                @endif

                                @if ( $record->field_40->city)
                                <li class="list-group-item">{{'City: ' . $record->field_40->city }}</li>
                                @endif

                                @if ($record->field_40->state)
                                <li class="list-group-item">{{'State: ' .  $record->field_40->state }}</li>
                                @endif

                                @if ($record->field_40->country)
                                <li class="list-group-item">{{'Country: ' .  $record->field_40->country }}</li>
                            @endif
                            @if ($record->field_40->zip)
                            <li class="list-group-item">{{'Zip: ' .  $record->field_40->zip }}</li>
                            @endif
                            @if ($record->field_40->lng)
                            <li class="list-group-item">{{'Longitude: ' .  $record->field_40->lng }}</li>
                            @endif
                            @if ($record->field_40->lat)
                            <li class="list-group-item">{{'Latitude: ' .  $record->field_40->lat }}</li>
                            @endif
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
      <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Customer Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('/customer')}}" enctype="multipart/form-data" method="post">
                <div class="row form-group">
                    <div class="col-md-6">
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
                        @csrf
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="country">First Name <span class="required"><sup>*</sup></span>: </label></div>
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
                        <div class="col-md-4"><label for="ratings">Ratings <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                          <select name="ratings" id="ratings" class="form-control" required>
                            <option value="" selected>Choose</option>
                            <option value="3" selected>3</option>
                            <option value="4" selected>4</option>
                            <option value="5" selected>5</option>
                            <option value="10" selected>10</option>
                         </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-4">
                          <label for="state">State <span class="required"><sup>*</sup></span>: </label>
                      </div>
                      <div class="col-md-8">
                          <input type="text" id="state" name="state" class="form-control pull-left" placeholder="State" required>
                      </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-4">
                      <label for="country">Country <span class="required"><sup>*</sup></span>: </label>
                  </div>
                  <div class="col-md-8">
                      <input type="text" id="country" name="country" class="form-control" placeholder="Country" required>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-4"><label for="acquisition_date">Acquisition Date <span class="required"><sup>*</sup></span>: </label></div>
                  <div class="col-md-8">
                      <input type="date" name="acquisition_date" class="form-control" placeholder="dd/mm/yyyy" required>
                  </div>
                </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4"><label for="dob">Date-of-Birth <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                      </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="status">Status <span class="required"><sup>*</sup></span>: </label></div>
                            <div class="col-md-8">
                                <select name="status" id="status" class="form-control" required>
                                  <option value="" selected>Choose</option>
                                  <option value="Active">Active</option>
                                  <option value="Inative">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-4">
                              <label for="address">Address <span class="required"><sup>*</sup></span>: </label>
                          </div>
                          <div class="col-md-8">
                              <input type="text" id="address" name="address" class="form-control" placeholder="Address" required>
                          </div>
                     </div>
                     <div class="row mt-3">
                      <div class="col-md-4">
                          <label for="address_two">Address 2: </label>
                      </div>
                      <div class="col-md-8">
                          <input type="text" id="address_two" name="address_two" class="form-control pull-left" placeholder="Address 2">
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-4">
                          <label for="city">City <span class="required"><sup>*</sup></span>: </label>
                      </div>
                      <div class="col-md-8">
                          <input type="text" id="city" name="city" class="form-control" placeholder="City" required>
                      </div>
                 </div>

                      
               <div class="row mt-3">
                <div class="col-md-4">
                    <label for="zip">Zip <span class="required"><sup>*</sup></span>: </label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="zip" name="zip" class="form-control pull-left" placeholder="Zip" required>
                </div>
           </div>
           <div class="row mt-3">
            <div class="col-md-4">
                <label for="lng">Longitude: </label>
            </div>
            <div class="col-md-8">
                <input type="text" id="lng" name="lng" class="form-control" placeholder="longitude">
            </div>
       </div>
       <div class="row mt-3">
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

      {{-- ./modal --}}
</div>
  @section('scripts')
  <script>
      $(document).ready(function() {
        $('#customer_records').DataTable();
      });
  </script>
@endsection