<?php

namespace App\Http\Controllers\Api;

use App\Model\Cart;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function getProduct($id){
        $product = Product::where('category_id',$id)->get();

        return response()->json($product);

    }

    public function orderdone(Request $request){
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->qty = $request->qty;
        $order->sub_total = $request->subtotal;
        $order->vat = $request->vat;
        $order->total = $request->total;
        $order->payby = $request->payby;
        $order->pay = $request->pay;
        $order->due = $request->due;
        $order->order_date = date('d/m/Y');
        $order->order_month =date('F');
        $order->order_year = date('Y');
        $order->save();
        $orderId = $order->id;


        $contents = Cart::all();

        foreach ($contents as $content){
            $orderDetails = new OrderDetail();
            $orderDetails->order_id = $orderId;
            $orderDetails->product_id = $content->product_id;
            $orderDetails->product_quantity = $content->product_quantity;
            $orderDetails->product_price = $content->product_price;
            $orderDetails->sub_total = $content->sub_total;
            $orderDetails->save();
            $quantity = $orderDetails->product_quantity;


            $product = Product::where('id',$content->product_id)->first();
            $product->product_quantity = $product->product_quantity-$quantity;

//            $minus =    $productqty - $quantity;
//
//            $product = new Product();
//            $product->product_quantity = $minus;
            $product->save();

        }
        $cart = Cart::query()->delete();
    }
}
