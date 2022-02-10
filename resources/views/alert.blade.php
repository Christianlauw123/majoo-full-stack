@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $err)
            <li>{{$err}}</li>
            @endforeach
        </ul>
    </div>
@elseif (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="ajax-alert" style="display:none;">
    
</div>