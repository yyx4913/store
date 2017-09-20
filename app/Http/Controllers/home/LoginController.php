<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\StatusController;
use App\Http\Model\Member;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request) //登录页面
    {
        $url = urldecode($request->get('url'));
        return view('home.login',compact('url'));
    }

    public function toLogin(Request $request)  //判断是否登录成功
    {

        $username =$request->get('username');
        $user_pwd =$request->get('pwd');
        $code = $request->get('code');
        $session_code= $request->session()->get('code','');
        $status = new StatusController();
        if($code == $session_code)
        {
            if(strpos($username,'@')==false)
            {
                $member = Member::where('phone',$username)->first();

            }else{
                $member = Member::where('email',$username)->first();
            }
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
        }else{
            $status->status=1;
            $status->messages='验证码错误';
            return $status->doJson();
        }
    }



}
