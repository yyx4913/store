<?php

namespace App\Http\Tools;

use App\Http\Controllers\StatusController;

class SendTemplateSMS
{
    //主帐号
    private $accountSid = '8a216da85b3c225d015b3d4031e00136';

    //主帐号Token
    private $accountToken = 'fbb43a3edb3c43a69eb309cc6e165157';

    //应用Id
    private $appId = '8a216da85b3c225d015b3d403273013c';

    //请求地址，格式如下，不需要写https://
    private $serverIP = 'app.cloopen.com';

    //请求端口
    private $serverPort = '8883';

    //REST版本号
    private $softVersion = '2013-12-26';

    /**
     * 发送模板短信
     * @param to 手机号码集合,用英文逗号分开
     * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
     * @param $tempId 模板Id
     */
    public function sendTemplateSMS($to, $datas, $tempId)
    {
        //$m3_result = new M3Result;

        // 初始化REST SDK
        $rest = new CCPRestSmsSDK($this->serverIP, $this->serverPort, $this->softVersion);
        $rest->setAccount($this->accountSid, $this->accountToken);
        $rest->setAppId($this->appId);

        // 发送模板短信
        //  echo "Sending TemplateSMS to $to <br/>";
        $status = New StatusController();
        $result = $rest->sendTemplateSMS($to, $datas, $tempId);
        if ($result == NULL) {
            $status ->status =2; //
            $status ->messages ='result error!';
           // break;
        }
        if ($result->statusCode != 0) {
            $status ->status =$result->statusCode; //
            $status ->messages =$result->statusMsg ;

            //下面可以自己添加错误处理逻辑
        } else {
            $status ->status =0; //
            $status ->messages ='已发送！';
        }
        return $status;
    }
}

//sendTemplateSMS("18576437523", array(1234, 5), 1);
