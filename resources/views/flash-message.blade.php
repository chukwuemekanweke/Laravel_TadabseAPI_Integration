@if ($message = Session::get('success'))
<div class="alert alert-success alert-block mb-4 row">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif

@if(session('error'))
    <div class="alert alert-danger  alert-dismissable  mb-4 row d-flex justify-content-between">
        <span>
            <strong>Oops! </strong> {{ session('error') }}
        </span>
            <a href="#" class="close _alert-times" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif