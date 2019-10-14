<?php

namespace App\Http\Controllers\Api;

use App\Model\Cart;
use App\Model\Product;
use App\Model\Extra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function getProduct(Request $request,$id){
        $product = Product::where('id',$id)->first();


        if ($product->product_quantity>=1) {
            $product_id = Cart::all();
            $check = Cart::where('product_id', $id)->first();

            if ($check) {
                $cart = Cart::where('product_id', $id)->increment('product_quantity');
            } else {
                $cart = new Cart();
                $cart->product_id = $id;
                $cart->product_name = $product->product_name;
                $cart->product_quantity = 1;
                $cart->product_price = $product->selling_price;
                $cart->sub_total = $product->selling_price;
                $cart->save();

                return response()->json('done');
            }

            $t_cal = Cart::where('product_id', $id)->first();
            $t_cal->sub_total = $t_cal->product_quantity * $t_cal->product_price;
            $t_cal->save();
            return response()->json($t_cal);

        }

    }

    public function getCartProduct(){
        $cart = Cart::all();
        return response()->json($cart);
    }

    public function incrementCartProductById(Request $request,$id){
        $cart = Cart::find($id);
//        $cartProductId = $cart->product_id;
//        $product = Product::find($cartProductId);

//        if ($cart->product_quantity<=$product->product_quantity){
            $cart->increment('product_quantity');
//        }


        $t_cal = Cart::find($id);
        $t_cal->sub_total = $t_cal->product_quantity*$t_cal->product_price;
        $t_cal->save();
        return response()->json($t_cal);

    }

    public function decrementCartProductById(Request $request,$id){
        $cart = Cart::find($id);


      if($cart->sub_total>$cart->product_price) {
         $cart->decrement('product_quantity');
          $t_cal = Cart::find($id);
          $t_cal->sub_total = $t_cal->sub_total-$t_cal->product_price;
          $t_cal->save();
          return response()->json($t_cal);
      }
    }


    public function removeCartProductById($id){
        $cart = Cart::find($id)->delete();
    }

    public function vats(){
        $vat= Extra::get()->first();
        return response()->json($vat);

    }
}
