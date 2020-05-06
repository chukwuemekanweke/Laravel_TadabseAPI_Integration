@extends('pages.main')
@section('title', 'Job Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
  @include('flash-message')
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
        <span><strong>Response type: </strong> <span class="mark">{{ $response_type }}</span></span> 
        <a href="#" class="btn btn-outline-success" data-toggle="modal" data-target="#jobModal">Add New</a>
    </p>
    <p><span> <strong>Total Record(s):</strong></span> <span class="mark">{{ $total_items }}</span></p>
    <table class="table table-bordered table-striped table-hover mt-4" id="jobs_records">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">field_38</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
           @if (count($entity_records) > 0)
              @foreach ($entity_records as $record)
                  <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->field_38 }}</td> 
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
      <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Job Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('/job')}}" enctype="multipart/form-data" method="post">
                <div class="row form-group">
                    <div class="col-md-12">
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="country">Job <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" placeholder="Job" required>
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
        $('#jobs_records').DataTable();
      });
  </script>
@endsection