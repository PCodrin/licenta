<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Online Store</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h1 class="my-0 mr-md-auto font-weight-normal">Online Store</h1>
    @if (Auth::check())
        <p style="margin-right: 25px;">Name: {{Auth::user()->name}}</p>
        <p style="margin-right: 50px;">Wallet: {{Auth::user()->money}} RON</p>
        @if(Auth::user()->is_admin)
            <a class="btn btn-outline-primary" href="/products" style="margin-right: 25px;">Admin</a>
        @endif

        <a class="btn btn-outline-primary" href="/profile" style="margin-right: 25px;">Profile</a>
        <a class="btn btn-outline-primary" href="/orders" style="margin-right: 25px;">My Orders</a>
        <a class="btn btn-outline-primary" href="/shoppingCart" style="margin-right: 25px;">Cart</a>
        <a class="btn btn-outline-primary" href="/logout" style="margin-right: 25px;">Logout</a>
    @else
        <a class="btn btn-outline-primary" href="/login" style="margin-right: 25px;">Login</a>
        <a class="btn btn-outline-primary" href="/register" style="margin-right: 25px;">Register</a>
    @endif
</div>

<main role="main">

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Products</h1>
    </div>

    @if (session('successMsg'))
        <div class="alert alert-success">
            {{ session('successMsg') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            @foreach ($products as $index =>$product)
                @if(!$product->deleted)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h2 class="my-0 font-weight-normal">{{$product->name}}</h2>
                        </div>

                        <div class="card-body">
                            <p>{{$product->description}}</p>
                            <h5 class="card-title pricing-card-title" style="text-align:center">{{$product->price}}
                                RON</h5>

                            <form method="POST" action="/addToCart/{{$product->id}}">
                                @csrf
                                <input type="hidden" name="formPosition" value="form{{$index}}">
                                <button type="submit" class="btn btn-lg btn-block btn-outline-primary"
                                        style="margin-top: 10px">Add to Cart
                                </button>
                            </form>

                            <div class="notification is-danger">
                                <strong style="color:red;">{{ $errors->has('form'.$index) ?  $errors->get('form'.$index)[0] : ''}}</strong>
                                <strong style="color:red;">{{$product->out_of_stock ? 'Product Out Of Stock' : ''}}</strong>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<script src="../../assets/js/vendor/holder.min.js"></script>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
</body>
</html>
