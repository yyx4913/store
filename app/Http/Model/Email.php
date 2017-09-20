<?php
namespace App\Http\Model;

class Email {
    public $from; //发件人
    public $to;  //收件人
    public $cc ; //抄送
    public $theme; //主题
    public $attach ; //附件
    public $content; //发送内容
}
