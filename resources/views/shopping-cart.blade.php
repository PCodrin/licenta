<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Shopping Cart</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<!------ Include the above in your HEAD tag ---------->
<body>

<div class="container" style="margin-top: 3%">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <p style="display:none">{{$total = 0}} </p>


        @foreach($cartItems as $index => $cartItem)

            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..."
                                                             class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">{{ $products[$index]->name }}</h4>
                            <p>{{ $products[$index]->description }}</p>
                            <div class="notification is-danger">
                                @if($products[$index]->deleted)
                                    <strong style="color:red;">Produsul este indisponibil</strong>
                                @endif

                                @if($products[$index]->out_of_stock and !$products[$index]->deleted)
                                    <strong style="color:red;">Product Out Of Stock</strong>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
                <td data-th="Price">{{$products[$index]->price}}</td>
                <td data-th="Quantity">
                    <input form="form{{$index}}" name="form{{$index}}[quantity]" type="number"
                           value="{{$cartItem->quantity}}" min="1" max="5">
                </td>
                <td data-th="Subtotal" class="text-center">{{ $products[$index]->price * $cartItem->quantity }} RON</td>
                <td class="actions" data-th="">

                    <div class="notification is-danger">
                        <strong
                            style="color:red;">{{ $errors->has('form'.$index.'.quantity') ?  $errors->get('form'.$index.'.quantity')[0] : ''}}</strong>

                    </div>

                    <form id="form{{$index}}" method="POST" action="{{route('update', $cartItem->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                    </form>

                    <form method="POST" action="{{route('delete', $cartItem->id)}}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                    </form>
                </td>
            </tr>
            <p style="display:none">{{$total = $total + $products[$index]->price * $cartItem->quantity}} </p>
        @endforeach
        </tbody>
        <tfoot>

        <tr>
            <td><a href="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total {{$total}} RON</strong></td>
            <td>
                <form method="POST" action="/orders">
                    @csrf
                    <input type="hidden" name="products" value="saa">
                    <button type="submit" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></button>
                </form>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
    @include('errors')
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
