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
<a class="btn btn-outline-primary" href="/orders" style="margin-left: 90%; margin-top:1%">Back</a>
<h1 style="text-align:center">Orders</h1>
<div class="container" style="margin-top: 3%; margin-left: 15%">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:20%">Name</th>
            <th style="width:50%">Description</th>
            <th style="width:30%">Price</th>
            <th style="width:30%">Quantity</th>
            <th style="width:30%">Date</th>
        </tr>
        </thead>

        <tbody>
        @foreach($orderDetails as $index => $orderDetail)

            <tr>
                <td data-th="Name">
                    <div class="control">
                        <p>{{$orderDetail->name}}</p>
                    </div>

                </td>
                <td data-th="Description">
                    <div class="control">
                        <p>{{$orderDetail->description}}</p>
                    </div>
                </td>
                <td data-th="Price">
                    <div class="control">
                        <p>{{$orderDetail->price}}</p>
                    </div>
                </td>
                <td data-th="Quantity">
                    <div class="control">
                        <p>{{$orderDetail->quantity}}</p>
                    </div>
                </td>

                <td data-th="Date">
                    <div class="control">
                        <p>{{$orderDetail->created_at}}</p>
                    </div>
                </td>

            </tr>

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
