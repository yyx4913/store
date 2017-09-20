<?php

namespace App\Http\Controllers\home;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StatusController;
use App\Http\Model\Email;
use App\Http\Model\Member;
use App\Http\Model\TempEmail;
use App\Http\Model\TmpPhone;
use App\Http\Tools\UUID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;

class RegisterController extends Controller
{
    public function register()  //注册页面
    {
        return view('home.register');
    }

    public function toRegister()  //验证注册用户消息
    {
        $status = new StatusController();
        $res = Input::all();
        $member = New Member;
        if(array_key_exists('phone',$res))
        {
            $first= substr($res['phone'],0,1); //获取第一个字符
            if(strlen($res['phone'])!=11 || $res['phone']=='' || $first !=1){
                $status -> status =3;
                $status -> messages ='电话号码不正确';
                return $status->doJson();
            }
            $tmpPhone =New TmpPhone();

            $info = $tmpPhone->checkCode($res['phone'],$res['code']);
            if($info){
                if($res['pass']==$res['pass_again'])
                {
                    $time =$tmpPhone->checkTime($res['phone']);
                    if(time()<strtotime($time))
                    {
                        $member->phone = $res['phone'];
                        $member->passward =md5('yyx' + $res['pass']);
                        $member->save();
                        $status -> status =0;
                        $status -> messages ='注册成功';
                    }else{
                        $status -> status =5;
                        $status -> messages ='验证码错误';
                    }

                }else{
                    $status -> status =4;
                    $status -> messages ='两次密码不相同';
                }
            }else{
                $status -> status =4;
                $status -> messages ='验证码错误';
            }
            return $status->doJson();
        }
        else{

            $t1 = strpos($res['email'],'@');
            $t2 = strpos($res['email'],'.');
            if($t1==false || $t2 == false){
                $status -> status =3;
                $status -> messages ='邮箱格式不正确';
                return $status->doJson();
            }
            if($res['code']== '' || strlen($res['code'])!=4)
            {
                $status -> status =5;
                $status -> messages ='验证码错误';
                return $status->doJson();
            }
            $code_session =session('code');
            if($code_session !=$res['code'])
            {
                $status -> status =6;
                $status -> messages ='验证码错误';
                return $status->doJson();
            }
            $member1 = Member::where('email',$res['email'])->first();
            if($member1!= null){
                $status -> status =7;
                $status -> messages ='该邮箱已经被注册了,请换一个';
                return $status->doJson();
            }
            if($res['pass'] ==$res['pass_again'])
            {
                $member->email = $res['email'];
                $member->passward = md5('yyx' + $res['pass']);
                $member->save();
                //发送邮件
                $uuid = UUID::create(); //生成一段随机数
                $email = New Email();
                $email->to = $res['email'];
                $email->cc ='果园的问候';
                $email->theme ="来之果吧的邮件";
                $email->content = '请于24小时点击该链接完成验证. http:// www.store.com/validateEmail'
                    . '?member_id=' . $member->id
                    . '&code=' . $uuid;

                $temp_email = TempEmail::where('m_id',$member->id)->first();
                if($temp_email==null)
                {
                    $temp_email = new TempEmail();
                }
                $temp_email->m_id = $member->id;
                $temp_email->code =$uuid;
                $temp_email->dead_time = date('Y-m-d H:i:s',time()+24*3600);//24小时链接过期
                $temp_email->save();

                Mail::send('email_register', ['email' => $email], function ($m) use ($email) {
                    // $m->from('hello@app.com', 'Your Application');
                    $m->to($email->to, '尊敬的用户')
                        ->cc($email->cc)
                        ->subject($email->theme);
                });
                $status -> status =0;
                $status -> messages ='注册成功,请前往邮箱激活账号';
                return $status->doJson();
            }
        }

    }




}
