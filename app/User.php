<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function shoppingCarts(){
        return $this->hasMany(ShoppingCart::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'user_id');
    }

    public function createShoppingCart(){
        $this->shoppingCarts()->create();
    }

    public function allOrders(){
        return $this->orders()->all();
    }

    public function myShoppingCart(){
        return $this->shoppingCarts()->latest('id')->first();
    }

    public function createOrder($cartItems){
        $order = $this->orders()->create();

        foreach($cartItems as $cartItem)
        {
            $product= Product::find($cartItem->product_id);

            $order->orderDetails()->create([
                "name" => $product->name,
                "description" => $product->description,
                "price" => $product->price,
                "quantity" =>$cartItem->quantity
            ]);
        }
        return;
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','money',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
