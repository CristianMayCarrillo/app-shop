<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
        $CartDetail = new CartDetail();
        $CartDetail->cart_id = auth()->user()->cart->id;
        $CartDetail->product_id = $request->product_id;
        $CartDetail->quantity = $request->quantity;
        $CartDetail->save();

        $notification='el producto se ha cargado a tu carrito de compras exitosamente';
        return back()->with(compact('notification'));
    }

     public function destroy(Request $request)
    {
        $CartDetail = CartDetail::find($request->cart_detail_id);

        if ($CartDetail->cart_id == auth()->user()->cart->id)
        $CartDetail->delete();

    	$notification='El producto se ha eliminado correctamente del carrito';
        return back()->with(compact('notification'));
    }
}
