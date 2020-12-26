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
                                <a href="{{ route('displayproductbycat',["id"=>$category->id]) }}" class="sub-nav-link">{{$subcategory->name}}</a>
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
    <div class="product-single">
        <div class="container section-container">
            <div class="product_img">
                <img src="{{ asset('images/'.$product->img_path) }}" alt="product_img" class="w-64 lg:w-96">
            </div>
            <div class="product-details">
                <h2 class="product-title">{{ $product->title }}</h2>
                <p class="product-description">
                    {{ $product->description}}
                </p>
                @foreach ($product_categories->categories as $category)
                    <a href="{{ route('displayproductbycat',["id"=>$category->id]) }}" class="product-categories">
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="comment_wrapper container">
        <h2 class="section-title">Comments</h2>
        <div class="comments_wrapper">
            @foreach($comments->comments as $comment)
                <div class="display-comment">
                    <strong>{{ $comment->user->name }}</strong>
                    <p>{{ $comment->body }}</p>
                </div>
                <form action="{{ route('storecomment') }}" method="POST">
                    @csrf
                    <div class="reply-comment-wrapper">
                        <input type="text" name="comment_content" class="form-control" />
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                        <button class="btn btn-primary" value="Reply">Replay</button>
                    </div>
                </form>
            @endforeach
            @auth
            <form action="{{ route('storecomment') }}" method="POST">
                @csrf
                <div class="post-comment-wrapper">
                    <input type="text" name="comment_content" class="form-control" />
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="hidden" name="parent_id" value="0" />
                    <button class="btn btn-primary" value="Reply">Post Comment</button>
                </div>
            </form>
            @endauth
        </div> 
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
</body>
</html>