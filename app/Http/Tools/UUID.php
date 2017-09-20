<?php

namespace App\Http\Tools;

class UUID {  //发送邮件

    static function create($prefix = '') {

        $chars = md5(uniqid(mt_rand(), true));

        $uuid = substr($chars,0,32);
        return $prefix . $uuid;
    }
}