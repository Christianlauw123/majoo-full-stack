<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">{{env('APP_NAME')}}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <div class="d-flex flex-wrap">
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          @if (auth()->check())
            @if(!empty(request()->path()) && request()->path() != "/")
              @if(auth()->user()->role == "Admin")
              <li><a href="{{url('product_categories')}}" class="nav-link px-2 link-light">Master Kategori Produk</a></li>
              <li><a href="{{url('products')}}" class="nav-link px-2 link-light">Master Produk</a></li>
              @endif
            @else
              <li><a href="{{ url('products') }}" class="nav-link px-2 link-light">Backoffice</a></li>
            @endif
            <li><a href="{{ url('logout') }}" class="nav-link px-2 link-light">Logout</a></li>
          @else
              <li><a href="{{ url('login') }}" class="nav-link px-2 link-light">Login</a></li>
            </ul>
          @endif
          </ul>
        </div>
      </div>
      
    </div>
  </nav>
</header>
