@extends('admin.master')
@section('title','后台登录')

@section('content')
    <link href="{{asset('admin/css/H-ui.login.css')}}" rel="stylesheet" type="text/css" />
    <div class="loginWraper">
        <div id="loginform" class="loginBox">
            <form class="form form-horizontal" >
                <div class="row cl">
                    {{csrf_field()}}
                    <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                    <div class="formControls col-xs-8">
                        <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                    <div class="formControls col-xs-8">
                        <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
                    </div>
                </div>
                <div class="row cl">
                    <div class="formControls col-xs-8 col-xs-offset-3">
                        <input class="input-text size-L" type="text" name="code" placeholder="验证码" style="width:9em;">
                        <img src="{{url('imgCode')}}" onclick="this.src='{{url('imgCode')}}?p='+Math.random()"/> </div>
                </div>
                <div class="row cl">
                    <div class="formControls col-xs-8 col-xs-offset-3">
                        <label for="online">
                            <input type="checkbox" name="online" id="online" value="">
                            使我保持登录状态</label>
                    </div>
                </div>
            </form>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <button class="btn btn-success radius size-L" onclick="_onLogin()">&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;</button>
                    <button class="btn btn-default radius size-L" >&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">Copyright 云易科技 @果吧</div>
    <script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/H-ui.min.js')}}"></script>
    @endsection

@section('footer')
    <script type="text/javascript">
        function _onLogin()  //后台登录
        {
            var username = $('input[name=username]').val();
            var pwd = $('input[name=password]').val();
            var code = $('input[name=code]').val();
            var token = $('input[name=_token]').val();
            if (username == '' || pwd == '' || code == '') {
                layer.msg('填好完整信息', {icon: 2, time: 2000});
                return false;
            }
            if (code.length !=4) {
                layer.msg('验证码错误', {icon: 2, time: 2000});
                return false;
            }
            $.ajax({
                url:'/admin/toLogin',
                type:'POST',
                dataType: 'json',
                cache:false,
                data:{'username':username,'pwd':pwd,'code':code,'_token':token},
                success:function(data){
                    console.log(data)
                    if(data == null) {
                        layer.msg('服务器开挂啦！~~',{icon: 2, time: 2000});

                        return;
                    }
                    if(data.status != 0) {

                        layer.msg(data.messages,{icon: 2, time: 2000});
                        return;
                    }

                    layer.msg(data.messages,{icon: 1, time: 2000});
                    location.href ='/admin/index';
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }

            });

        }
    </script>
@endsection