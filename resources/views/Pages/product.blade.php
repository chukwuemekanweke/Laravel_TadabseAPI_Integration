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
    <table class="table table-bordered table-striped table-hover mt-4" id="customer_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_65</th>
            <th scope="col">field_66</th>
            <th scope="col">field_73</th>
            <th scope="col">field_75</th>
            <th scope="col">field_75_val</th>
          </tr>
        </thead>
        <tbody>
           @if (count($entity_records) > 0)
              @foreach ($entity_records as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_65 }}</td>
                    <td>{{ $record->field_66 }}</td>
                    <td>
                        <ul class="list-group">
                          <li class="list-group-item">
                              <img src="{{ $record->field_73->src }}" alt="na"  class="w-100 rounded">
                          </li>
                          <li class="list-group-item">{{ 'width: ' . $record->field_73->width }}</li>
                          <li class="list-group-item">{{ 'height: ' . $record->field_73->height }}</li>
                          <li class="list-group-item">{{ 'public_id: ' .  $record->field_73->public_id }}</li>
                      </ul>
                    
                    </td>
                    
                    <td>
                      @if (count($record->field_75) > 0)
                          @foreach ($record->field_75 as $item)
                              {{ $item }}
                          @endforeach
                      @endif
                    </td>
                    <td>
                        <div class="card">
                            <div class="card-body">
                                @foreach ($record->field_75_val  as $item)
                                    {{'id: ' . $item->id }} <br>
                                    {{'val: ' . $item->val }}
                                @endforeach
                            </div>
                        </div>
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