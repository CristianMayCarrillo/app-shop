<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update()
    {
    	$cart = auth()->user()->cart;
    	$cart->status = 'Pending';
    	$cart->save(); //update

    	$notification = 'Tu pedido se a registrado correctammete te contactaremos via E-mail';
    	return back()->with(compact('notification'));
    }
}
