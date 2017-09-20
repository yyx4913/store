<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\StatusController;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function cate()
    {
        $categorys= Category::whereNull('p_id')->get();
        $fruits = Category::where('p_id','!=','Null')->orderBy('cate_order','asc')->take(3)->get();//推荐水果
        return view('home.category',compact('categorys','fruits'));

    }

    public function getCate($p_id)  //全部分类
    {
        $categorys =Category::where('p_id',$p_id)->get();
        $status=new StatusController();

        if($categorys->isEmpty()){
            $status->status=1;
            $status->messages='暂无此类水果信息';
            $status->cate=0;
        }else{
            $status->status=0;
            $status->messages='加载成功~~';
            $status->cate= $categorys;
        }
        return $status->doJson();
    }


}
