@extends('main')

@section('header')
@include('frontoffice.header')
@endsection

@section('content')
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Produk</h1>
    
    <div class="row justify-content-center">
        @foreach($products as $key => $product)
        
        @if (($key+1) % 4 == 0)
            <div class="card" style="width: 18rem;">
        @else
            <div class="card" style="width: 18rem;margin-right:2.5% !important;">
        @endif
            <img src="{{asset('storage/'.$product->image_path)}}" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
                <div class="text-center">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <h5 class="card-title">{{number_format($product->price,0,",",".")}}</h5>
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


