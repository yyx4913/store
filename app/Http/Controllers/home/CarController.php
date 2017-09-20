<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\StatusController;
use App\Http\Model\CarItems;
use App\Http\Model\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CarController extends Controller  //添加购物车
{
    public function addCar(Request $request,$pro_id)
    {
        //用户已登录
        $status =new StatusController();
        $status->status=0;
        $status->messages ='添加成功';
        $member = Session::get('member'); //用户登录的情况
        if($member !='')
        {
            $member_id =$member->id;
            $car_items = CarItems::where('member_id',$member_id)->get();
            $exist =false;
            foreach($car_items as $car_item){
                if($car_item->pro_id == $pro_id){
                    $car_item->count++;
                    $car_item->save();
                    $exist =true;
                    break;
                }
            }
            if($exist==false){
                $car_item =new CarItems;
                $car_item->member_id = $member_id;
                $car_item->pro_id=$pro_id;
                $car_item->count=1;
                $car_item->save();
            }
            return $status->doJson();
        }

        $car = $request->cookie('car');

        $car_arr =$car !=null ? explode(',',$car) : array();
        $count=1;
        foreach($car_arr as &$v){
            $k = strpos($v,':');
            $p_id =substr($v,0,$k);
            if($p_id ==$pro_id)
            {
                $count = ((int)substr($v,$k+1)) +1;
                $v = $pro_id .':'.$count;
                break;
            }
        }
        if($count ==1)
        {
            array_push($car_arr,$pro_id .':'.$count);
        }

        return response($status->doJson())->withCookie('car',implode(',',$car_arr));
    }

    public function Car_info(Request $request) //查看购物车（本地存贮的Cookie）
    {
        $car =$request->cookie('car');
        $car_items=array();
        $car_arr = $car !=null ?explode(',',$car):array();

        $member = Session::get('member'); //用户登录的情况
        if($member !='')
        {
            $member_id =$member->id;
            $car_items =$this->MemberCar($car_arr,$member_id);//用户登录的购物车

            return response()->view('home.carinfo',compact('car_items'))->withCookie('car',null);
        }

        foreach($car_arr as $k=>$v){
            $index =strpos($v,':');
            $car_item =New CarItems();
            $car_item->id = $k;
            $car_item->pro_id =substr($v,0,$index);
            $car_item->count =(int)substr($v,$index+1);
            $car_item->product = Product::find($car_item->pro_id);
            if($car_item->product !=null){
                array_push($car_items,$car_item);
            }
        }
        return view('home.carinfo',compact('car_items'));
    }

    public function MemberCar($car_arr,$member_id) //用户登录后的购物车
    {
        $car_items=CarItems::where('member_id',$member_id)->get();
        $car_items_arr =array();
        foreach($car_arr as $k=>$v){
            $exits =false;
            $index =strpos($v,':');
            $pro_id =substr($v,0,$index);
            $count =(int)substr($v,$index+1);
            foreach ($car_items as $car_item) {
                if($car_item->pro_id ==$pro_id){
                    if($car_item->count<$count){
                        $car_item->count =$count;
                        $car_item->save();
                    }
                    $exits =true;
                    break;
                }

            }
            if($exits ==false){
                $car_item = new CarItems;
                $car_item->member_id =$member_id;
                $car_item->pro_id = $pro_id;
                $car_item->count = $count;
                $car_item->save();
                array_push( $car_items_arr,$car_item);
            }
        }

        foreach($car_items as $car_item){
            $car_item->product =Product::find($car_item->pro_id);
            array_push($car_items_arr,$car_item);
        }
        return $car_items_arr;
    }

    public function delCar(Request $request) //删除购物车信息
    {
        $status =new StatusController();
        $status->status=0;
        $status->messages ='删除成功';
        $pro_ids =$request->input('pro_ids','');
        if($pro_ids ==null)
        {
            $status->status=1;
            $status->messages ='没有选中商品的ID';
            return $status->doJson();
        }
        $pro_arr = explode(',',$pro_ids);

        $member = Session::get('member'); //用户登录的情况
        if($member !='')
        {
            $member_id =$member->id;
            $car_items = CarItems::where('member_id',$member_id)->get();
            foreach($car_items as $car_item){
                if(in_array($car_item->pro_id,$pro_arr))
                {
                    $car =new CarItems;
                    $car->where('pro_id',$car_item->pro_id)->delete();
                    continue;
                }
            }
            return $status->doJson();
        }

        $car =$request->cookie('car');

        $car_arr = $car !=null ?explode(',',$car):array();
        foreach($car_arr as $k=>$v)
        {
            $index = strpos($v, ':');
            $pro_id = substr($v,0,$index);
            if(in_array($pro_id,$pro_arr))
            {
                array_splice($car_arr,$k,1);
                continue;
            }
        }

        return response($status->doJson())->withCookie('car',implode(',',$car_arr));
    }


}
