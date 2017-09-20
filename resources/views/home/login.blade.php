<!-- 登录界面-->
@extends('home/master')

@section('title','登录')
@section('js')
    <script src="js/jquery-1.11.2.min.js"></script>
@endsection
@section ('content')
    <div class="weui_cells_title">选择账号登录</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">帐号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                {{csrf_field()}}
                <input class="weui_input" type="tel" placeholder="邮箱或手机号" name="username"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name="user_pwd"/>
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入验证码" name="code"/>
            </div>
            <div class="weui_cell_ft">
                <img src="{{url('imgCode')}}" class="bk_validate_code" onclick="this.src='{{url('imgCode')}}?p='+Math.random()"/>
            </div>
        </div>
    </div>
    <div class="weui_cells_tips"></div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" onclick="onLoginClick('{{$url}}')">登录</a>
    </div>
    <a href="/register" class="bk_bottom_tips bk_important">没有帐号? 去注册</a>
@endsection

@section('my-js')
    <script src="js/home.js"></script>
    @endsection