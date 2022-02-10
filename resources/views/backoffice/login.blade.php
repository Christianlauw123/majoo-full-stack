@extends('main')

@section('header')
@include('frontoffice.header')
@endsection

@section('content')
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Login</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('alert')
                    <form action="{{url('login')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</main>
@endsection

 
@section('footer')
@include('frontoffice.footer')
@endsection


