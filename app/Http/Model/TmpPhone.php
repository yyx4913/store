<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TmpPhone extends Model
{
    protected $table = 'tmp_phone';
    protected $primaryKey ='id';
    public $timestamps =false;

    public function checkCode($phone,$code) //验证验证码是否正确
    {
        $phone = $this::where('phone',$phone)->first();
        if($phone){
            if($phone->code ==$code)
            {
                return true;
            }
        }
        return false;
    }

    public function checkTime($phone) //获取时间
    {
        $phone = $this::where('phone',$phone)->first();
        if($phone) {
            return $phone->deadline_time;
        }
    }
}
