@extends('pages.main')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    <p>
        <span>Response type: </span> <span class="mark">{{ $reponse_type }}</span>
    </p>
    <table class="table table-bordered table-striped table-hover mt-4" id="schema_table">
        <thead>
          <tr>
            <th scope="col">Slug</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
          </tr>
        </thead>
        <tbody>
           @if (count($describe_table) > 0)

               @foreach($describe_table as $field)
                <tr>
                    <td>{{ $field->slug }}</td>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->type }}</td>
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
        $('#schema_table').DataTable();
      });
  </script>
@endsection