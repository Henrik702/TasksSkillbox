@if(session()->has('massage'))
    <div class="alert alert-success">
        {{ session('massage') }}
    </div>delete
@endif

@if(session()->has('delete'))
    <div class="alert alert-danger">
        {{ session('delete') }}
    </div>
@endif

@if(session()->has('uvidamlenia'))
    <div class="alert alert-success">
        {{ session('uvidamlenia') }}
    </div>
@endif
