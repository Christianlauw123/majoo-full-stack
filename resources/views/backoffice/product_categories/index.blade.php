@extends('main')

@section('header')
@include('frontoffice.header')
@endsection

@section('content')
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Master Kategori Produk</h1>
    <a href="{{url('/product_categories/create')}}" class="btn btn-sm btn-primary">Create</a>
    <div class="row">
      @include('alert')
      <div class="table-responsive">
        <table class="table table-bordered" id="tabel_product_category" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
      </div>    
    </div>
  </div>
</main>
@endsection

 
@section('footer')
@include('frontoffice.footer')
@endsection

@section('script')
@include('backoffice.product_categories.script')
@endsection

