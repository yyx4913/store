<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\imageController;
use App\Http\Controllers\StatusController;
use App\Http\Model\Member;
use App\Http\Model\TempEmail;
use App\Http\Model\TmpPhone;
use App\Http\Tools\SendTemplateSMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ValidateController extends Controller
{
    public function imgCode(Request $request) //邮箱登录验证码
    {
        $img =new imageController();
        $request->session()->put('code',$img->getCode());
        return $img->doimg(); //对外声称验证码
    }

    public function sendSMS(Request $request){//短信验证
        $phone = $request->input('phone','');
        $status = new StatusController();
        if($phone =='')
        {
            $status ->status =1 ;
            $status->messages='电话号码不能为空！！';
            return $status->doJson();
        }
        if(strlen($phone) != 11 || $phone[0] != '1') {
            $status->status = 2;
            $status->messages = '手机格式不正确';
            return $status->doJson();
        }
        $member=Member::where('phone',$phone)->first();
        if($member!=null){
            $status->status = 3;
            $status->messages = '该用户名已被注册，请您换一个';
            return $status->doJson();
        }

        $sendTemplate = new SendTemplateSMS();
        $code ='';
        for($i=0;$i<4;$i++){
            $code.=mt_rand(0,9);
        }
        $info = $sendTemplate->sendTemplateSMS($phone, array($code,30),1);
        if($info->status ==0){
            $tmpPhone = TmpPhone::where('phone',$phone)->first();
            if($tmpPhone == null){
                $tmpPhone = new TmpPhone();
            }
            $tmpPhone->phone = $phone;
            $tmpPhone->code = $code;
            $tmpPhone->deadline_time = date('Y-m-d H:i:s',time()+5*60);
            $tmpPhone->save();
        }

        return $info->doJson();
    }

    public function validateEmail(Request $request) //验证邮箱
    {
        $m_id =$request->input('member_id','');

        $code =$request->input('code','');
        $temp_email = new TempEmail();
        $info = $temp_email->where('m_id',$m_id)->first();
        if($info =='')
        {
            return '验证失败';
        }else{

            if(time() < strtotime($info['dead_time']))
            {
                if($code == $info['code'])
                {

                    $member = Member::find($m_id);
                    $member->active = 1;
                    $member->save();
                    echo "<script>alert('账号激活成功，正在跳转到网站首页....');location.href='/index'</script>";
                    return;
                }
            }
            return '链接失效';
        }

    }
}
