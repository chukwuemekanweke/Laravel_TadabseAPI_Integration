@extends('pages.main')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p>
        <span>Response type: </span> <span class="mark">{{ $response_type }}</span>
        <a href="#" class="btn btn-outline-success">Add New</a>
    </p>
    <p><span> <strong>Total Record(s):</strong></span> <span class="mark">{{ $total_items }}</span></p>
    <table class="table table-bordered table-striped table-hover mt-4" id="tasks_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_57</th>
            <th scope="col">field_58</th>
            <th scope="col">field_59</th>
            <th scope="col">field_60</th>
            <th scope="col">field_60_val</th>
          </tr>
        </thead>
        <tbody>
           @if (count($entity_records) > 0)
              @foreach ($entity_records as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_57 }}</td>
                    <td>{{ $record->field_58 }}</td>
                    <td>{{ $record->field_59 }}</td>
                    <td>
                        @if (count($record->field_60) > 0)
                       
                            @foreach ($record->field_60 as $item)
                                <div class="card">
                                    <div class="card-body">
                                        {{ $item }}
                                    </div>
                                </div>
                            @endforeach
                        @else 

                        @endif
                    </td>
                    <td>
                        @if (count($record->field_60_val) > 0)
                       
                            @foreach ($record->field_60_val as $item)
                                <div class="card">
                                    <div class="card-body">
                                        {{'id: ' . $item->id }} <br>
                                        {{ 'val: ' . $item->val }}
                                    </div>
                                </div>
                            @endforeach
                        @else 

                        @endif
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
        $('#tasks_records').DataTable();
      });
  </script>
@endsection