<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/weui.css')}}">
    <link rel="stylesheet" href="{{asset('css/weui1.css')}}">
    <link rel="stylesheet" href="{{asset('css/me.css')}}">
    @section('js')
    @show
</head>
<body>
<div class="title">
    <img src="{{asset('images/more.png')}}" style="float:right;" onclick="onMenuClick();">
    <img src="{{asset('images/f.png')}}" style="float:left;" onclick="history.go(-1)">
    <div class="title_content"></div>
</div>
<div class="page">

    @section('content')
        
        @show
</div>
@section('footer')

@show()
<!-- tooltips -->
<div class="bk_toptips"><span></span></div>

{{--<div id="global_menu" onclick="onMenuClick();">--}}
    {{--<div></div>--}}
{{--</div>--}}

<!--BEGIN actionSheet-->
<div id="actionSheet_wrap">
    <div class="weui_mask_transition" id="mask"></div>
    <div class="weui_actionsheet" id="weui_actionsheet">
        <div class="weui_actionsheet_menu">
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(1)">首页</div>
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(2)">购物车</div>
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(3)">订单查询</div>
            <div class="weui_actionsheet_cell" onclick="onMenuItemClick(4)">用户中心</div>
        </div>
        <div class="weui_actionsheet_action">
            <div class="weui_actionsheet_cell" id="actionsheet_cancel">取消</div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript">
    //获取标题
    $(".title_content").html(document.title) ;
    function hideActionSheet(weuiActionsheet, mask) {
        weuiActionsheet.removeClass('weui_actionsheet_toggle');
        mask.removeClass('weui_fade_toggle');
        weuiActionsheet.on('transitionend', function () {
            mask.hide();
        }).on('webkitTransitionEnd', function () {
            mask.hide();
        })
    }

    function onMenuClick () {
        var mask = $('#mask');
        var weuiActionsheet = $('#weui_actionsheet');
        weuiActionsheet.addClass('weui_actionsheet_toggle');
        mask.show().addClass('weui_fade_toggle').click(function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        $('#actionsheet_cancel').click(function () {
            hideActionSheet(weuiActionsheet, mask);
        });
        weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
    }

    function onMenuItemClick(index) {
        var mask = $('#mask');
        var weuiActionsheet = $('#weui_actionsheet');
        hideActionSheet(weuiActionsheet, mask);
        if(index == 1) {
            location.href='/index';
        } else if(index == 2) {
            location.href='/carinfo';
        } else if(index == 3){
            location.href='/orders';
        } else {
            $('.bk_toptips').show();
            $('.bk_toptips span').html("敬请期待!");
            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
        }
    }
</script>
@yield('my-js')

</html>
