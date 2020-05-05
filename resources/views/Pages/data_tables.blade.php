@extends('pages.main')
@section('title', 'Entities')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    <p>
        <span><strong>Response type:</strong> </span> <span class="mark">{{ $response_type }}</span>
    </p>
    <p><span> <strong>Total Schema(s):</strong></span> <span class="mark">{{ $total_tables }}</span></p>
    <table class="table table-bordered table-striped table-hover mt-4" id="data_table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
           @if(count($data_tables) > 0)
                @foreach ($data_tables as $table)
                    <tr>
                        <td>{{ $table->id}}</td>
                        <td>{{ $table->name}}</td>
                        <td>
                            <a href="{{ url('schema/'.$table->id . '/type/' . $table->name )}}" class="btn btn-info">View Schema</button>
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
        $('#data_table').DataTable();
      });
  </script>
@endsection