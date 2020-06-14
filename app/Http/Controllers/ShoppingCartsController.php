<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cartItems = auth()->user()->myShoppingCart()->shoppingCartItems;

        $products = [];
        foreach ($cartItems as $cartItem) {
            if(Product::find($cartItem->product_id)){
                $product = Product::find($cartItem->product_id);
                $products [] = $product;
            }
        }

        return view('/shopping-cart', [
            'cartItems' => $cartItems,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createCart()
    {
        ShoppingCart::create([
            'user_id' => Auth::id()
        ]);
    }

}
