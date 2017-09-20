<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StatusController;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CategoryController extends  controller{

    public function category()
    {
        $cates=  Category::all();
        foreach($cates as $cate){
            if($cate->p_id !=null && $cate->p_id !='')
            {
                $cate->parent = Category::find($cate->p_id);
            }
        }
        return view('admin.category',compact('cates'));
    }

    public function add_cate()
    {
        $cates=Category::whereNull('p_id')->get();
        return view('admin.add_cate',compact('cates'));
    }

    public function add_cateinfo(Request $request)
    {
        $status =new StatusController();
        $p_name = $request->get('p_name','');
        $cate_name = $request->get('cate_name','');
        $cate_order = $request->get('cate_order','');
        if($cate_name!='')
        {
            if($p_name==''){ $p_name = Null; }
            $category =new Category;
            $category->p_id = $p_name;
            $category->cate_name = $cate_name;
            $category->cate_order = $cate_order;
            $category->save();



            $status->status = 0;
            $status->messages ='添加成功';
        }else{
            $status->status = 1;
            $status->messages ='添加失败';
        }
        return $status->doJson();
    }

    public function delCate($cate_id){  //删除
        if($cate_id!=''){
            $status =New StatusController();
            $res = Category::where('cate_id',$cate_id)->delete();
            if($res){
                $status->status =0;
                $status->messages ='删除成功';

            }else{
                $status->status =1;
                $status->messages ='删除失败';
            }
            return $status->doJson();
        }
    }

    public function editCate($cate_id){ //编辑信息
        $cates=Category::whereNull('p_id')->get();
        if($cate_id!=''){
            $category = Category::find($cate_id);
            return view('admin.edit_cate',compact('cates','category'));
        }
    }

    public function editCateinfo(Request $request)
    {
        $cate_id =$request->get('cate_id','');
        $cate =  Category::find($cate_id);
        $status =new StatusController();
        $cate->p_id = $request->get('p_name','');
        $cate->cate_name = $request->get('cate_name','');
        $cate->cate_order = $request->get('cate_order','');
        $res =$cate->save();
        if($res){
            $status->status =0;
            $status->messages ='修改成功';
        }else{
            $status->status =1;
            $status->messages ='修改失败';
        }
        return $status->doJson();
    }
}