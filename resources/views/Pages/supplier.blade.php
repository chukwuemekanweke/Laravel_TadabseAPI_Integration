@extends('pages.main')
@section('title', 'Supplier Entity')
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
    <table class="table table-bordered table-striped table-hover mt-4" id="supplier_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_68</th>
            <th scope="col">field_69</th>
            <th scope="col">field_70</th>
            <th scope="col">field_71</th>
          </tr>
        </thead>
        <tbody>
           @if (count($entity_records) > 0)
              @foreach ($entity_records as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_68 }}</td>
                    <td>{{ $record->field_69 }}</td>
                    <td>{{ $record->field_70 }}</td>
                    <td>{{ $record->field_71}}</td>
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
        $('#supplier_records').DataTable();
      });
  </script>
@endsection