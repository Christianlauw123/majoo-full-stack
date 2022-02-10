
@extends('main')

@section('header')
@include('frontoffice.header')
@endsection

@section('content')
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">{{$state == "edit" ? "Edit" : ($state == "create" ? "Create" : "Show")}} Master Produk</h1>
    <div class="row">
        <div class="card">
            <div class="card-body">
                @if ($state != "show")
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
                            <input type="text" class="form-control" name="name" placeholder="Nama" aria-label="Nama" value="{{ old('name')!= null ? ($state == 'edit' ? $product->name : old('name')) : ($state == 'edit' ? $product->name : '') }}">
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Deskripsi</span>
                            </div>
                        </div>
                        <textarea id="description" class=" mb-3" style="width:100% !important;" aria-label="Deskripsi" name="description">{{ old('description')!= null ? ($state == 'edit' ? $product->description : old('description')) : ($state == 'edit' ? $product->description : '') }}</textarea>

                        <div class="input-group mb-3" style="margin-top:2% !important;">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Harga</span>
                            </div>
                            <input type="text" class="form-control" name="price" placeholder="Harga" aria-label="Harga" value="{{ old('price')!= null ? ($state == 'edit' ? $product->price : old('price')) : ($state == 'edit' ? $product->price : '') }}">
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Gambar Produk</span>
                            </div>
                            <input type="file" name="image_path" class="form-control">
                        </div>

                        @if($state == "edit")
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Gambar Produk Yang Telah Terupload</label>
                            <div class="col-sm-10">
                                <img src="{{asset('storage/'.$product->image_path)}}" width="200" height="200"/>
                            </div>
                        </div>
                        @endif

                        
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Kategori Produk</label>
                            </div>
                            <select id="product_categories" class="form-control"  name="product_category_id">
                                <option disabled selected>--Select Role--</option>
                                @foreach($product_categories as $category)
                                    @php
                                        $selected = '';
                                        if ($state == "edit")
                                            $selected = $category->id == $product->product_category_id ? 'selected' : '';

                                    @endphp
                                    <option value="{{$category->id}}" {{$selected}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <div class="progress">
                                <div id="percent" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>
                        <button class="btn btn-primary"  type="submit">{{$state == "edit" ? "Edit" : "Create"}}</button>
                    </form>
                @else
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        {{$product->name}}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        Rp {{number_format($product->price,2,",",".")}}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Deskripsi</label>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Kategori Produk</label>
                    <div class="col-sm-10">
                        {{$product->product_category->name}}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Gambar Produk</label>
                    <div class="col-sm-10">
                        <img src="{{asset('storage/'.$product->image_path)}}" width="200" height="200"/>
                        
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</main>
@endsection

 
@section('footer')
@include('frontoffice.footer')
@endsection

@section('script')
@include('backoffice.products.script')
@endsection

