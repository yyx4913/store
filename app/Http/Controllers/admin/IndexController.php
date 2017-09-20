<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class IndexController extends  controller{

    public function index() //后台首页
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }



    public function toLogin(Request $request)
    {

    }
}