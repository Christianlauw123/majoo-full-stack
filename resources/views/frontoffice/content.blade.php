@extends('main')

@section('header')
@include('frontoffice.header')
@endsection

@section('content')
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Produk</h1>
    
    <div class="row">
        @foreach($products as $key => $product)
        <div class="card" style="width: 20rem;margin:0 auto;">
            <img src="{{asset('storage/'.$product->image_path)}}" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
                <div class="text-center">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <h5 class="card-title" style="margin-top:10%;">Rp {{number_format($product->price,0,",",".")}}</h5>
                </div>
                <p class="card-text">{!! $product->description !!}</p>
                
            </div>
            <div class="card-footer" style="border-top:0px !important; background-color:transparent;">
                <div class="text-center">
                    <a href="#" class="btn btn-sm btn-outline-secondary">Beli</a>
                </div>
            </div>
        </div>
        
        @endforeach
    </div>
  </div>
</main>
@endsection

 
@section('footer')
@include('frontoffice.footer')
@endsection


