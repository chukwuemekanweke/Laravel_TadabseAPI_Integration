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
</div>
  @section('scripts')
  <script>
      $(document).ready(function() {
        $('#customer_records').DataTable();
      });
  </script>
@endsection