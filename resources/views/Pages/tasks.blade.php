@extends('pages.main')
@section('title', 'Task Entity')
@section('content')
<div class="container-fluid">
    @include('Layout.navbar')
</div>
<div class="container mt-5">
    @include('flash-message')
    <h3 class="text-info">Records for {{ $schema_name ?? 'N/A'}}</h3>
    <p class="d-flex justify-content-between">
        <span><strong>Response type: </strong> <span class="mark">{{ $response_type }}</span></span> 
        <a href="#" class="btn btn-outline-success" id="add-tasks" data-toggle="modal" data-target="#tasksModal">Add New</a>
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
            <th>Action</th>
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
       <!-- Modal -->
       <div class="modal fade" id="tasksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Task Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('task')}}" enctype="multipart/form-data" method="post">
                <div class="row form-group">
                    <div class="col-md-12">
                      <div class="row mt-3">
                        <div class="col-md-4"><label for="name">Name <span class="required"><sup>*</sup></span>: </label></div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" placeholder="Tasks" required>
                           
                        </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-4"><label for="description">description: </label></div>
                      <div class="col-md-8">
                          <textarea name="description" id="description" cols="30" rows="4" class="form-control" placeholder="Say something about the task"></textarea>
                      </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-4"><label for="due_date">Due Date <span class="required"><sup>*</sup></span>: </label></div>
                    <div class="col-md-8">
                        <input type="date" class="form-control" name="due_date" placeholder="dd/mm/yyyy" required>
                        @csrf
                    </div>
                </div>
                {{-- TODO: assigned to --}}
               {{--  <div class="row mt-3">
                  <div class="col-md-4"><label for="email">Assign To <span class="required"><sup>*</sup></span>: </label></div>
                  <div class="col-md-8">
                      <select name="assign_to" id="assign_to">
                         
                      </select>
                      
                  </div>
              </div> --}}
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
        $('#tasks_records').DataTable();
      });
  </script>
@endsection