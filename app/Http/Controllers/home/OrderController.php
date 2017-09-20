<?php

namespace App\Http\Controllers\home;

use App\Http\Model\CarItems;
use App\Http\Model\OrderItems;
use App\Http\Model\Orders;
use App\Http\Model\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller   //购物车结算
{
    public function OrderCar(Request $request,$pro_ids){  //购物车结算

        $pro_ids_arr=explode(',',$pro_ids);
        $member=$request->session()->get('member');
        if($member->id !=null){
            $car_items =array();
            $price=0;
            $car_items_arr=CarItems::where('member_id',$member->id)->whereIn('pro_id',$pro_ids_arr)->get();
            foreach ($car_items_arr as $car_item){
                $car_item->product =Product::find($car_item->pro_id);
                if($car_item->product !=null)
                {
                    $price+=$car_item->count*($car_item->product->price);
                    array_push($car_items,$car_item);
                }
            }

        }
        return view('home.order_pay',compact('car_items','price'));
    }

    public function findOrder(Request $request) //订单查询
    {
        $member = $request->session()->get('member');
        if($member->id!=null)
        {
            $orders=Orders::where('member_id',$member->id)->get();
            foreach($orders as $order)
            {
                $order_items = OrderItems::where('order_id',$order->id)->get();
                $order->order_items = $order_items;
                $count=0;
                foreach ($order_items as $order_item){
                    $order_item->product = Product::find($order_item->pro_id);
                    $count+=1;
                }
                $order->count =$count;
            }
        }
        return view('home.orders',compact('orders'));
    }
}
