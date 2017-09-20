<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StatusController;
use App\Http\Model\Admin;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LoginController extends  controller{

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

        $username =$request->get('username');
        $user_pwd =$request->get('pwd');
        $code = $request->get('code');
        $session_code= $request->session()->get('code','');
        $status = new StatusController();
        if($code == $session_code)
        {
            $member = Admin::where('username',$username)->first();
            if($member == null)
            {
                $status->status=2;
                $status->messages='用户不存在';

                return $status->doJson();
            }else{
                if(md5('yyx'+$user_pwd)==$member->passward){
                    $status->status=0;
                    $status->messages='登录成功';
                    $request->session()->put('member',$member);
                    return $status->doJson();
                }else{
                    $status->status=3;
                    $status->messages='用户名或密码错误';
                    return $status->doJson();
                }
            }
        }
        else{
            $status->status=1;
            $status->messages='验证码错误';
            return $status->doJson();
        }
    }
}