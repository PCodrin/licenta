<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    protected $guarded = [];

    public function shoppingCart(){
        return $this->belongsTo( ShoppingCart::class);
    }

    public function deleteCartItem($cartItemId){
        $this->delete($cartItemId);
    }
}
