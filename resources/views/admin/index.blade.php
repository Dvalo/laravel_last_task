<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <table class="table">
            <tr>
                <td>#</td>
                <td>Title</td>
                <td>Description</td>
                <td>Image</td>
                <td>Created At</td>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td><img src="{{ asset('images/'.$product->img_path) }}" /></td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <form action="{{ route('admindelete',["id"=>$product->id ]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                        <a href="{{ route('adminedit',["id"=>$product->id ]) }}" class="btn btn-warning">
                            Update
                        </a>
                        <a href="" class="btn btn-success">
                            Info
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" ></script>
</body>
</html>