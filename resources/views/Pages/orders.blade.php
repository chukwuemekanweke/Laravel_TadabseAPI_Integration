@extends('pages.main')
@section('title', 'Order Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
        <span><strong>Response type: </strong> <span class="mark">{{ $response_type }}</span></span> 
        {{-- <a href="#" class="btn btn-outline-success">Add New</a> --}}
    </p>
    <p><span> <strong>Total Record(s):</strong></span> <span class="mark">{{ $total_items }}</span></p>
    <table class="table table-bordered table-striped table-hover mt-4" id="order_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_43</th>
            <th scope="col">field_44</th>
            <th scope="col">field_45</th>
            <th scope="col">field_72</th>
            <th scope="col">field_74</th>
            <th scope="col">field_45_val</th>
            <th scope="col">field_72_val</th>
            <th scope="col">field_74_val</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($entity_records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_43  }}</td>
                    <td>{{ $record->field_44 }}</td>
                    <td>
                        &#10098; 
                            @if(count($record->field_45) > 0)
                                
                                @foreach ($record->field_45 as $inner_list)
                                    {{ '"' . $inner_list . '"' . ',' }}
                                @endforeach
                            @endif
                        &#10099;
                    </td>
                    <td>{{ 'yet to'}}</td>
                    <td>{{ 'yet to' }}</td>
                    <td>
                        &#10098; 
                            @if(count($record->field_45_val) > 0)
                                
                                @foreach ($record->field_45_val as $inner_list)
                                    {{ '"' . $inner_list . '"' . ',' }}
                                @endforeach
                            @endif
                        &#10099;
                    </td>
                    <td>
                        &#10098; 
                            @if(count($record->field_72_val) > 0)
                            <ul class="list-group">
                                @foreach ($record->field_72_val as $inner_list)
                                    <li class="list-group-item">{{ 'id: ' .$inner_list->id }} <br> {{ 'val: ' .$inner_list->id }}</li>
                                @endforeach
                            </ul>
                            @endif
                        &#10099;
                    </td>
                    <td>
                         &#10098; 
                            @if(count($record->field_74_val) > 0)
                                
                                @foreach ($record->field_74_val as $inner_list)
                                    {{ '"' . $inner_list . '"' . ',' }}
                                @endforeach
                            @endif
                        &#10099;
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</div>
  @section('scripts')
  <script>
      $(document).ready(function() {
        $('#order_records').DataTable();
      });
  </script>
@endsection