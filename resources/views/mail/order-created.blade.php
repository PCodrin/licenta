@component('mail::message')

    Thank you for your purchase from Online-Store.

    Hi {{ $user->name }}, we're getting your order ready to be shipped. We will notify you when it has been sent.

    @component('mail::table')
        | Details     | Quantity      | Price    |
        | ----------- |:-------------:| --------:|
        @foreach( $orderDetails as $orderDetail)
        | {{$orderDetail->name}}    | {{$orderDetail->quantity}}      | {{$orderDetail->price}}      |
        @endforeach
    @endcomponent

Thanks,<br>
Online-Store
@endcomponent




