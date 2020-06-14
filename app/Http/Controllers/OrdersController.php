<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = auth()->user()->orders;

        return view('/orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $cartItems = auth()->user()->myShoppingCart()->shoppingCartItems;

        $messages = $this->validare($cartItems);
        if (!empty($messages)) {
            return redirect()->back()->withErrors(['messages' => $messages]);
        }
        auth()->user()->createOrder($cartItems);
        $this->updateAll($cartItems);

        $user = auth()->user();
        $orderDetails = auth()->user()->orders()->latest('id')->first()->orderDetails;



        Mail::to($user->email)->send(
            new OrderCreated($user, $orderDetails)
        );

        return redirect('/')->with('successMsg', 'Comanda a fost inregistrata cu succes');
    }

    public function updateAll($cartItems)
    {
        $totalMoney = 0;
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id); //modificam sa fie odata cu select where in
            $totalMoney += ($product->price * $cartItem->quantity);
            $value = $product->in_stock - $cartItem->quantity;
            $product->update(['in_stock' => $value]);
        }
        $money = auth()->user()->money - $totalMoney;
        auth()->user()->update(['money' => $money]);

        auth()->user()->myShoppingCart()->update(['active' => 0]);
        auth()->user()->createShoppingCart();
        return;
    }


    public function validare($cartItems)
    {
        $totalMoney = 0;
        $messages = [];
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            $totalMoney += ($product->price * $cartItem->quantity);
            if ($product->deleted) {
                $messages [] = "Produsul '" . $product->name . "' este indisponibil! Va rugam sa-l stergeti din cos!";
            } elseif ($product->out_of_stock) {
                $messages [] = "Produsul '" . $product->name . "' nu mai este pe stoc! Va rugam sa-l stergeti din cos!";
            } elseif ($product->in_stock < $cartItem->quantity) {
                $messages [] = "Produsul '" . $product->name . "' a suferit modificari!";
                $cartItem->update(['quantity' => $product->in_stock]);
            }

        }
        if (auth()->user()->money < $totalMoney) {
            $messages [] = "Not Enough Money";
        }
        return $messages;


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */

    public function show(Order $order)
    {
        $orderDetails = $order->orderDetails;

        return view('/orders.show', compact('orderDetails'));
    }

}
