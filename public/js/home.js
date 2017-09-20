/**
 * Created by Administrator on 2017/4/5.
 */
function checkPhone() //判断手机号码格式
{
    var enable =true;
    if(enable ==false){
        return ;
    }
    var phone = $('input[name=phone]').val();//手机号不能为空
    if(phone =='')
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('请输入手机号,手机号不能为空！');
        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
        return;
    }
    if(phone.length != 11 || phone[0]!=1) //手机格式
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('手机格式不正确');
        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
        return;
    }
    enable =false;
    var num =60;  //定义60s后再发短息
    $('.bk_phone_code_send').removeClass('bk_important');
    $('.bk_phone_code_send').addClass('bk_summary');
    var interval = window.setInterval(function () {
        $('.bk_phone_code_send').html(--num + 's后再发送');
        if(num==0)
        {
            window.clearInterval(interval);
            $('.bk_phone_code_send').removeClass('bk_summary');
            $('.bk_phone_code_send').addClass('bk_important');
            $('.bk_phone_code_send').html('重新发送');
            enable= true;
        }
    },1000);

    $.ajax({
        url:'/sendCode',
        dataType:'json',
        cache:false,
        data:{phone :phone},
        success:function(data){
            if(data ==null) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('服务端错误');
                setTimeout(function () {
                    $('.bk_toptips').hide()
                }, 2000);
                return;
            }
            if(data !=0){
                $('.bk_toptips').show();
                $('.bk_toptips span').html(data.messages);
                setTimeout(function () {
                    $('.bk_toptips').hide()
                }, 2000);
                return;
            }

            $('.bk_toptips').show();
            $('.bk_toptips span').html('短信发送成功');
            setTimeout(function () {
                $('.bk_toptips').hide()
            }, 2000);
            return;
        },
        error:function(hr ,status, error){
            console.log(hr);
            console.log(status);
            console.log(error);
        }
    });

}

function onRegisterClick()
{  //判断客户端登录信息
    var token =  $('input[name=_token]').val();
    var id = $('input:radio[name=register_type]:checked').attr('id');
    if(id =='x11'){ //手机注册
        var phone = $('input[name=phone]').val();
        var pass =$('input[name=passwd_phone]').val();
        var pass_again =$('input[name=passwd_phone_cfm]').val();
        var code =$('input[name=phone_code]').val();
        var data = {'phone':phone, 'pass':pass,
            'pass_again':pass_again,
            'code':code,'_token':token };
        //console.log(data);
        if(verifyPhone(phone,pass,pass_again,code)==false)
        {
            return ;
        }

    }
    else if(id =='x12')
    {
        var email = $('input[name=email]').val();
        var pass = $('input[name=passwd_email]').val();
        var pass_again =$('input[name=passwd_email_cfm]').val();
        var code = $('input[name=validate_code]').val();
        data = {'email':email, 'pass':pass,'pass_again':pass_again,
            'code':code, '_token':token};
        if(verifyEmail(email,pass,pass_again,code)==false)
        {
            return ;
        }

    }
    //console.log(data);
    url ='/toRegister';
    $.post(url,data,function(result){

        result = JSON.parse(result);
        if(result.status==0)
        {
            $('.bk_toptips').show();
            $('.bk_toptips span').html(result.messages);
            setTimeout(function(){$('.bk_toptips').hide()},2000);
            return ;
        }else{
            $('.bk_toptips').show();
            $('.bk_toptips span').html(result.messages);
            setTimeout(function(){$('.bk_toptips').hide()},2000);
            return ;
        }
    });
}

    function verifyPhone(phone,pass,pass_again,code)//验证手机号码
    {
        if(phone=='' || pass==''||pass_again==''||code =='')
        {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('请补充完整信息');
            setTimeout(function () {
                $('.bk_toptips').hide()
            }, 2000);
            return false;
        }
        if(phone.length != 11 || phone[0]!=1) //手机格式
        {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('手机格式不正确');
            setTimeout(function(){$('.bk_toptips').hide()},2000);
            return false;
        }
        if(code.length==4){
            if(pass.length >=6 && pass_again.length >=6){
                if(pass_again !=pass){ //验证两次密码是否相同
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('两次输入的密码不相同');
                    setTimeout(function(){$('.bk_toptips').hide()},2000);
                    return false;
                }
            }else{
                $('.bk_toptips').show();
                $('.bk_toptips span').html('密码长度不小于6');
                setTimeout(function(){$('.bk_toptips').hide()},2000);
                return false;
            }

        }else{
            $('.bk_toptips').show();
            $('.bk_toptips span').html('验证码输入错误');
            setTimeout(function(){$('.bk_toptips').hide()},2000);
            return false;
        }
    }

    function verifyEmail(email,pass,pass_again,code)//验证邮箱
    {
        if(email!='' || pass!='' || pass_again!='' || code !='')
        {
            if(email.indexOf('@') == -1 || email.indexOf('.') == -1) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('邮箱格式有问题');
                setTimeout(function(){$('.bk_toptips').hide()},2000);
                return false;
            }
            if(code.length==4){
                if(pass.length >=6 && pass_again.length >=6){
                    if(pass_again !=pass){ //验证两次密码是否相同
                        $('.bk_toptips').show();
                        $('.bk_toptips span').html('两次输入的密码不相同');
                        setTimeout(function(){$('.bk_toptips').hide()},2000);
                        return false;
                    }
                }else{
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('密码长度不小于6');
                    setTimeout(function(){$('.bk_toptips').hide()},2000);
                    return false;
                }

            }else{
                $('.bk_toptips').show();
                $('.bk_toptips span').html('验证码输入错误');
                setTimeout(function(){$('.bk_toptips').hide()},2000);
                return false;
            }
    }

}

function onLoginClick(gourl)  //登录验证
{
    var username = $('input[name=username]').val();
    var pwd =$('input[name=user_pwd]').val();
    var code = $('input[name=code]').val();
    var token =$('input[name=_token]').val();
    if(username =='' ||pwd =='' || code=='')
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('请填好必要信息');
        setTimeout(function(){$('.bk_toptips').hide()},2000);
        return false;
    }
    if(code.length !=4)
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码错误');
        setTimeout(function(){$('.bk_toptips').hide()},2000);
        return false;
    }
    if(pwd.length<6){
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码输入错误');
        setTimeout(function(){$('.bk_toptips').hide()},2000);
        return false;
    }

    $.ajax({
        url:'/toLogin',
        type:'POST',
        dataType: 'json',
        cache:false,
        data:{'username':username,'pwd':pwd,'code':code,'_token':token},
        success:function(data){
            if(data == null) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('服务端开外挂啦~~~');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            if(data.status != 0) {

                $('.bk_toptips').show();
                $('.bk_toptips span').html(data.messages);
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }

             $('.bk_toptips').show();
             $('.bk_toptips span').html('登录成功');
             setTimeout(function() {$('.bk_toptips').hide();}, 2000);
             location.href=gourl;
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }

    });
}

function getCate(p_id)  //根据P_id获取子分类
{
    $.ajax({
        url:'/cate/p_id/'+p_id,
        type:'GET',
        dataType:'json',
        cache:false,
        success:function(data){
            if(data == null) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('服务端开外挂啦~~~');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            $('.bk_toptips').show();
            $('.bk_toptips span').html(data.messages);
            setTimeout(function() {$('.bk_toptips').hide();}, 500);
            if(data.cate ==0){
                var info ='<center><img src="/images/wu.png">&nbsp;&nbsp;&nbsp;&nbsp;暂时没有此类水果信息</center>';
                $('.weui_cells_access').html(info);
                return;
            }
            $('.weui_cells_access').html('');
            for(var i=0;i<data.cate.length;i++)
            {
                var url ='product_list/cate_id/'+data.cate[i].cate_id;
                var node='<a class="weui_cell " href="'+ url +'">'+
                    '<div class="weui_cell_bd weui_cell_primary">'+
                '<p>'+ data.cate[i].cate_name +'</p>'+ '</div>'+'<div class="weui_cell_ft">好吃~</div>'+
                '</a>';

                $('.weui_cells_access').append(node);
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }

    })
}

function _addCar(p_id)  //添加购物车
{
    $.ajax({
        url:'/addCar/p_id/' + p_id,
        type:'GET',
        dataType:'json',
        cache:false,
        success:function(data){
            if(data == null) {
                console.log(data);
                $('.bk_toptips').show();
                $('.bk_toptips span').html('服务端开外挂啦~~~');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            if(data.status != 0) {

                $('.bk_toptips').show();
                $('.bk_toptips span').html(data.messages);
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            var num = $('#num').html();
            if(num=='')  num=0;
            $('#num').html(parseInt(num)+1);
        },
        error:function(xhr, status, error){
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    })
}

function _delCar() //删除购物车
{
    var push =[];
    $('input[name=car_item]:checked').each(function(i){
        push[i]=$(this).val();
    });

    if(push.length==0)
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('请选择要删除的商品~~');
        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
        return;
    }
   //console.log(push);
    $.ajax({
        type:'GET',
        url:'/delcar',
        dataType:'json',
        cache:false,
        data:{'pro_ids':push+''},
        success:function(data){
            if(data == null) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('服务端开外挂啦~~~');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            if(data.status != 0) {

                $('.bk_toptips').show();
                $('.bk_toptips span').html(data.messages);
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }

            location.reload();
        },
        error:function(xhr, status, error){
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });

}

function _toCharge(){ //购物车结算
    var push =[];
    $('input[name=car_item]:checked').each(function(i){
        push[i]=$(this).val();
    });

    if(push.length==0)
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('请选择要删除的商品~~');
        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
        return;
    }
    location.href='/orderCar/pro_ids/'+ push;
}

function _onLogin()  //后台登录
{
    var username = $('input[name=username]').val();
    var pwd =$('input[name=password]').val();
    var code = $('input[name=code]').val();
    var token =$('input[name=_token]').val();
    if(username =='' ||pwd =='' || code=='')
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('请填好必要信息');
        setTimeout(function(){$('.bk_toptips').hide()},2000);
        return false;
    }
    if(code.length <4)
    {
        $('.bk_toptips').show();
        $('.bk_toptips span').html('验证码错误');
        setTimeout(function(){$('.bk_toptips').hide()},2000);
        return false;
    }
    if(pwd.length<6){
        $('.bk_toptips').show();
        $('.bk_toptips span').html('密码输入错误');
        setTimeout(function(){$('.bk_toptips').hide()},2000);
        return false;
    }

    $.ajax({
        url:'admin/toLogin',
        type:'POST',
        dataType: 'json',
        cache:false,
        data:{'username':username,'pwd':pwd,'code':code,'_token':token},
        success:function(data){
            console.log(date)
            if(data == null) {
                $('.bk_toptips').show();
                $('.bk_toptips span').html('服务端开外挂啦~~~');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }
            if(data.status != 0) {

                $('.bk_toptips').show();
                $('.bk_toptips span').html(data.messages);
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return;
            }

            $('.bk_toptips').show();
            $('.bk_toptips span').html('登录成功');
            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
            location.href=gourl;
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }

    });
}

