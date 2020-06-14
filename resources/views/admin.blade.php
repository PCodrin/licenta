<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <a class="btn btn-outline-primary" href="/" style="margin-left: 90%; margin-top:1%">Home</a>
    <h1 style="text-align:center">Products</h1>
    <div class="container" style="margin-top: 3%; margin-left: 15%">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:20%">Name</th>
                <th style="width:50%">Description</th>
                <th style="width:30%">Price</th>
                <th style="width:30%">Quantity</th>
                <th style="width:30%">Out of Stock</th>
                <th style="width:30%">Commands</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td data-th="Name">
                    <div class="control">
                        <input form="form" type="text" class="input" name="form[name]" placeholder="Name" value="">
                    </div>
                    <div class="notification is-danger" >
                        <strong style="color:red;">{{ $errors->has('form.name') ?  $errors->get('form.name')[0] : ''}}</strong>
                    </div>
                </td>
                <td data-th="Description">
                    <div class="control">
                        <textarea form="form" style="width:100%; padding:10px" name="form[description]" placeholder="Description" class="textarea"></textarea>
                    </div>
                    <div class="notification is-danger" >
                        <strong style="color:red;">{{ $errors->has('form.description') ?  $errors->get('form.description')[0] : ''}}</strong>
                    </div>
                </td>
                <td data-th="Price">
                    <div class="control">
                        <input form="form" type="number" class="input" name="form[price]" placeholder="Price" value="0" min="0">
                    </div>
                    <div class="notification is-danger" >
                        <strong style="color:red;">{{ $errors->has('form.price') ?  $errors->get('form.price')[0] : ''}}</strong>
                    </div>
                </td>
                <td data-th="Quantity">
                    <div class="control">
                        <input form="form" type="number" class="input" name="form[in_stock]" placeholder="Quantity" value="0" min="0" >
                    </div>
                    <div class="notification is-danger" >
                        <strong style="color:red;">{{ $errors->has('form.in_stock') ?  $errors->get('form.in_stock')[0] : ''}}</strong>
                    </div>
                </td>

                <td data-th="OutOfStock">

                </td>

                <td class="actions" data-th="Commands">

                    <div class="notification is-danger">

                    </div>

                    <form  id="form" method="POST" action="/products">
                        @csrf
                        <button  type="submit" class="btn btn-info btn-sm">Create</button>
                    </form>

                </td>
            </tr>


            @foreach($products as $index => $product)
                @if(!$product->deleted)
                <tr>
                    <td data-th="Name">
                        <div class="control">
                            <input form="form{{$index}}" type="text" class="input" name="form{{$index}}[name]" placeholder="Name" value="{{ $product->name }}">
                        </div>
                        <div class="notification is-danger" >
                            <strong style="color:red;">{{ $errors->has('form'.$index.'.name') ?  $errors->get('form'.$index.'.name')[0] : ''}}</strong>
                        </div>
                    </td>
                    <td data-th="Description">
                        <div class="control">
                            <textarea form="form{{$index}}" style="width:100%; padding:10px" name="form{{$index}}[description]" placeholder="Description" class="textarea">{{ $product->description }}</textarea>
                        </div>
                        <div class="notification is-danger" >
                            <strong style="color:red;">{{ $errors->has('form'.$index.'.description') ?  $errors->get('form'.$index.'.description')[0] : ''}}</strong>
                        </div>
                    </td>
                    <td data-th="Price">
                        <div class="control">
                            <input form="form{{$index}}" type="number" class="input" name="form{{$index}}[price]" placeholder="Price" value="{{$product->price}}">
                        </div>
                        <div class="notification is-danger" >
                            <strong style="color:red;">{{ $errors->has('form'.$index.'.price') ?  $errors->get('form'.$index.'.price')[0] : ''}}</strong>
                        </div>
                    </td>
                    <td data-th="Quantity">
                        <div class="control">
                            <input form="form{{$index}}" type="number" class="input" name="form{{$index}}[in_stock]" placeholder="Quantity" value="{{$product->in_stock}}">
                        </div>
                        <div class="notification is-danger" >
                            <strong style="color:red;">{{ $errors->has('form'.$index.'.in_stock') ?  $errors->get('form'.$index.'.in_stock')[0] : ''}}</strong>
                        </div>
                    </td>

                    <td data-th="OutOfStock">
                        <div class="control">
                            <input form="form{{$index}}" type="hidden" name="form{{$index}}[out_of_stock]" value="0" />
                            <input form="form{{$index}}" type="checkbox" name="form{{$index}}[out_of_stock]" value="1" {{ $product->out_of_stock ? 'checked' : ''}}>
                        </div>
                    </td>

                    <td class="actions" data-th="Commands">

                        <div class="notification is-danger">

                        </div>

                        <form  id="form{{$index}}" method="POST" action="/products/{{$product->id}}">
                            @csrf @method('PUT')
                            <button  type="submit" class="btn btn-info btn-sm">Edit</button>
                        </form>

                        <form method="POST" action="/products/{{$product->id}}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</main>
</body>
</html>
