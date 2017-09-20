<?php

namespace App\Http\Controllers\home;

use App\Http\Model\Prodcutcontent;
use App\Http\Model\Product;
use App\Http\Model\proImages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getProduct($cate_id) //产品列表
    {
        $products = Product::where('cate_id',$cate_id)->get();
        return view('home.product_list',compact('products'));
    }

    public function getContent(Request $request,$p_id){ //产品详细信息
        $product = Product::find($p_id);
        $content = Prodcutcontent::where('pro_id',$p_id)->first();

        $imgs =proImages::where('pro_id',$p_id)->get();
        $car = $request->cookie('car');
        $car_arr =$car !=null ? explode(',',$car) : array();
        $count=0;
        foreach($car_arr as $v){

            $k = strpos($v,':');
            $pro_id =substr($v,0,$k);
            if($pro_id ==$p_id)
            {
                $count = (int)substr($v,$k+1);
                break;
            }
        }

        return view('home.getContent',compact('product','content','imgs'))->with('count',$count);
    }


}
