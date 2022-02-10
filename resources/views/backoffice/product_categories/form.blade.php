
@extends('main')

@section('header')
@include('frontoffice.header')
@endsection

@section('content')
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">{{$state == "edit" ? "Edit" : "Create"}} Master Kategori Produk</h1>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    @include('alert')
                    <form action="{{$url}}" method="POST">
                        @csrf
                        @if($state == "edit")
                            {{method_field("PUT")}}
                        @endif
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Nama</span>
                            </div>
                            <input type="text" class="form-control" name="name" placeholder="Nama" aria-label="Nama" value="{{ old('name')!= null ? ($state == 'edit' ? $product_category->name : old('name')) : ($state == 'edit' ? $product_category->name : '') }}">
                        </div>

                        
                        <button class="btn btn-primary" type="submit">{{$state == "edit" ? "Edit" : "Create"}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

 
@section('footer')
@include('frontoffice.footer')
@endsection

