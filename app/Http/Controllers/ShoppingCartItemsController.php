<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateAddItemToCart;
use App\Http\Requests\ValidateUpdateItemQuantity;
use App\Product;
use App\ShoppingCart;
use App\ShoppingCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartItemsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request, Product $product)
    {
        $shoppingCart = auth()->user()->myShoppingCart();
        $productFromCart = $shoppingCart->checkIfProductIsAlreadyInTheCart($product->id);
        if (!$product->out_of_stock) {
            if ($productFromCart) {
                if ($productFromCart->quantity < 5) {
                    $productFromCart->update(['quantity' => $productFromCart->quantity + 1]);
                } else {
                    return redirect()->back()->withErrors([$request->input('formPosition') => 'Cantitatea maxima a Produsului din cos a fost atinsa!']);
                }
            } else {
                $shoppingCart->addItem([
                    'product_id' => $product->id,
                ]);
            }
        }else{
            return redirect('/');
        }
        return redirect('/')->with('successMsg','The'.$product->name.' has been added to the cart');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ShoppingCartItem $shoppingCartItem
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateUpdateItemQuantity $request, ShoppingCartItem $shoppingCartItem)
    {
        $input = $request->except(['_token']);

        $value = reset($input)['quantity'];

        $shoppingCartItem->update(['quantity' => $value]);

        return redirect('/shoppingCart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ShoppingCartItem $shoppingCartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCartItem $shoppingCartItem)
    {
        $shoppingCartItem->delete();

        return redirect('/shoppingCart');
    }


}
