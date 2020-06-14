<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo( User::class, );
    }

    public function shoppingCartItems(){
        return $this->hasMany(ShoppingCartItem::class, 'shopping_cart_id');
    }

    public function checkIfProductIsAlreadyInTheCart($product_id){
        return $this->shoppingCartItems()->where('product_id', '=', $product_id)->first();
    }

    public function addItem($item)
    {
        $this->shoppingCartItems()->create($item);
    }


}
