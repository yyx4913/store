<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StatusController extends Controller  //判断信息的状态
{
    public $status;
    public $messages;

    function doJson()
    {
        return json_encode($this,JSON_UNESCAPED_UNICODE); //中文情况
    }
}
