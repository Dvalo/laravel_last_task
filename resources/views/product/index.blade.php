<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body>
    <nav id="main-navbar">
        <div class="container">
            <ul>
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('displayproductbycat',["id"=>$category->id]) }}" class="nav-link">{{ $category->name }}</a>
                    <div class="sub-nav-wrapper"> 
                        @foreach ($subcategories as $subcategory)
                            @if($subcategory->parent_id == $category->id)
                                <a href="{{ route('displayproductbycat',["id"=>$subcategory->id]) }}" class="sub-nav-link">{{$subcategory->name}}</a>
                            @endif
                        @endforeach
                    </div>
                </li>
            @endforeach
            </ul>
            <div class="avatar_wrapper">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            </div>
        </div>
    </nav>

    <div class="container section-container">
        <div class="popular-products">
            <h2 class="section-title">Popular Products</h2>
            <div class="products-wrapper grid-display">
                @foreach ($products as $product)
                    <div class="card-tile">
                        <a href="{{ route('displayproduct',["id"=>$product->id]) }}">
                            <img src="{{ asset('images/'.$product->img_path) }}" alt="product-image" class="card-image">
                        </a>
                        <div class="card-details">
                            <a href="/" class="card-title">{{ $product->title }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
</body>
</html>