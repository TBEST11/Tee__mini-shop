@if(session('success'))
    <div class="alert alert-primary" role="alert">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    @foreach (session('errors') as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}
    </div>
    @endforeach
@endif