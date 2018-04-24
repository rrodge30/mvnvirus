@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success') !== null && session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error') !== null && session('error'))
    <div class="alert alert-success">
        {{session('error')}}
    </div>
@endif

<div id="custom-error-message" class="alert alert-danger" style="display:none;">
        <p id="custom-error-message-text"></p>
</div>