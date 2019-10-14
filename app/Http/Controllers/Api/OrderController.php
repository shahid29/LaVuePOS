<?php

namespace App\Http\Controllers\Api;

use App\Model\Expense;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
   public function getOrder(){
       $date = date('d/m/Y');
       $order = Order::with('customer')->where('order_date',$date)->orderBy('id','DESC')->get();
       return $order;
   }

   public function getOrderDetails($id){
       $order = Order::with('customer')->where('id',$id)->first();
       return response()->json($order);

   }
   public function getAllOrderDetails($id){

       $details=DB::table('order_details')
           ->join('products','order_details.product_id','products.id')
           ->where('order_details.order_id',$id)
           ->select('products.product_name','products.product_code','products.image','order_details.*')
           ->get();
       return response()->json($details);
   }

   public function searchDate(Request $request){
       $date = $request->date;
       $convert = new \DateTime($date);
       $done = $convert->format('d/m/Y');
       $search = Order::with('customer')->where('order_date',$done)->orderBy('id','DESC')->get();
       return response()->json($search);
   }

    public function searchMonth(Request $request){
        $month = $request->month;
        $search = Order::with('customer')->where('order_month',$month)->orderBy('id','DESC')->get();
        return response()->json($search);
    }

    public function todaySell(){
       $date=date('d/m/Y');
       $todaysell = Order::where('order_date',$date)->sum('total');
       return response()->json($todaysell);
    }

    public function todayIncome(){
        $date=date('d/m/Y');
        $todayincome = Order::where('order_date',$date)->sum('pay');
        return response()->json($todayincome);
    }

    public function todayDue(){
        $date=date('d/m/Y');
        $due = Order::where('order_date',$date)->sum('due');
        return response()->json($due);
    }

    public function todayExpense(){
        $date=date('d/m/Y');
        $expense = Expense::where('expense_date',$date)->sum('amount');
        return response()->json($expense);
    }

    public function stockOut(){
        $product = Product::with('category')
            ->where('product_quantity','<','11')
            ->orderBy('id','DESC')->get();
        return response()->json($product);
    }
}
