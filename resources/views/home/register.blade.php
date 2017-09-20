@extends('home.master')
@section('title','注册')
@section('js')
    <script src="js/jquery-1.11.2.min.js"></script>
@endsection
@section('content')
    <div class="weui_cells_title">注册方式</div>
    <div class="weui_cells weui_cells_radio">
        {{csrf_field()}}
        <label class="weui_cell weui_check_label" for="x11">
            <div class="weui_cell_bd weui_cell_primary">
                <p>手机号注册</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" class="weui_check" name="register_type" id="x11" checked="checked" >
                <span class="weui_icon_checked"></span>
            </div>
        </label>

        <label class="weui_cell weui_check_label" for="x12">
            <div class="weui_cell_bd weui_cell_primary">
                <p>邮箱注册</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" class="weui_check" name="register_type" id="x12" >
                <span class="weui_icon_checked"></span>
            </div>
        </label>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="" name="phone" />
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_phone'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_phone_cfm'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="" name='phone_code'/>
            </div>
            <p class="bk_important bk_phone_code_send"  onclick="checkPhone()">发送验证码</p>
            <div class="weui_cell_ft">
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form" style="display:none;">
        <div class="weui_cell">

            <div class="weui_cell_hd"><label class="weui_label">邮箱</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="" name="email"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_email'>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_email_cfm'/>
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入验证码" name='validate_code'/>
            </div>
            <div class="weui_cell_ft">
                <img src="{{URL('imgCode')}}" class="bk_validate_code" onclick="this.src='{{url('imgCode')}}?p='+Math.random()"/>
            </div>
        </div>
    </div>
    <div class="weui_cells_tips"></div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" onclick="onRegisterClick();">注册</a>
    </div>
    <a href="/login" class="bk_bottom_tips bk_important">已有帐号? 去登录</a>

@endsection

@section('my-js')
    <script>
        $('#x12').next().hide();
        $('input:radio[name=register_type]').click(function(event){

            if($(this).attr('id') =='x11')
            {
                $('#x11').next().show();
                $('#x12').next().hide();
                $('.weui_cells_form').eq(0).show();
                $('.weui_cells_form').eq(1).hide();
            }else{
                $('#x11').next().hide();
                $('#x12').next().show();
                $('.weui_cells_form').eq(0).hide();
                $('.weui_cells_form').eq(1).show();
            }
        });
    </script>
    <script src="js/home.js"></script>
@endsection
