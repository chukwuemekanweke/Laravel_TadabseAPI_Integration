@extends('pages.main')
@section('title', 'Project Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
        <span><strong>Response type: </strong> <span class="mark">{{ $response_type }}</span></span> 
        <a href="#" class="btn btn-outline-success">Add New</a>
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
                    
                  </tr>
              @endforeach
           @else
           <tr>
                <td colspan="3" class="text-center">No table(s) available..</td>
            </tr>
           @endif
        </tbody>
      </table>
</div>
  @section('scripts')
  <script>
      $(document).ready(function() {
        $('#schema_records').DataTable();
      });
  </script>
@endsection