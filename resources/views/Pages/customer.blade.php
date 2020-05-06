@extends('pages.main')
@section('title', 'Customer Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
       <span> <strong> Response type:</strong> <span class="mark">{{ $response_type }}</span> </span>
        <a href="#" class="btn btn-outline-success">Add New</a>
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
                          <div class="col-md-4"><label for="proj_name">Title: </label></div>
                          <div class="col-md-8">
                            <input type="text" name="proj_name" class="form-control" placeholder="Name of project">
                            @csrf
                          </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="address_one">Address: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>
                    </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="country">Country: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="country" placeholder="Country">
                        </div>
                    </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="city">City: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="city" placeholder="City">
                        </div>
                    </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="lng">Longitude: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Longitude" name="lng">
                        </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-4"><label for="lat">Start Date: </label></div>
                      <div class="col-md-8">
                          <input type="datetime-local" class="form-control" placeholder="dd/mm/yyyy" name="start_date">
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4"><label for="created_on">Created On: </label></div>
                        <div class="col-md-8">
                            <input type="date" name="created_on" class="form-control">
                        </div>
                      </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="middle_name">Address 2: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="address_two" placeholder="Address 2">
                            </div>
                        </div>
                       
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="state">State: </label></div>
                            <div class="col-md-8">
                                <input type="text" name="state" class="form-control" placeholder="State">
                            </div>
                        </div>
                       
                        <div class="row mt-3">
                            <div class="col-md-4"><label for="zip">Zip: </label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Zip" name="zip">
                            </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-4"><label for="lat">Latitude: </label></div>
                          <div class="col-md-8">
                              <input type="text" class="form-control" placeholder="Latitude" name="lat">
                          </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="lat">Completion Date: </label></div>
                        <div class="col-md-8">
                            <input type="datetime-local" class="form-control" placeholder="dd/mm/yyyy" name="end_date">
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