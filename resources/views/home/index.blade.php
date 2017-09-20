@extends('home/master')
@section('title','果吧')
@section('js')
    <script src="{{asset('js/zepto.min.js')}}"></script>
    <script src="{{asset('js/swipe.js')}}"></script>
    @endsection
@section('content')
    <script>
        $(function(){
            $('#slide').swipeSlide({
                autoSwipe:true,//自动切换默认是
                speed:3000,//速度默认4000
                continuousScroll:true,//默认否
                transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
                lazyLoad:true,//懒加载默认否
                firstCallback : function(i,sum,me){
                    me.find('.dot').children().first().addClass('cur');
                },
                callback : function(i,sum,me){
                    me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
                }
            });
            $('#slide1').swipeSlide({
                autoSwipe:true,//自动切换默认是
                speed:4000,//速度默认4000
                continuousScroll:true,//默认否
                transitionType:'ease-in'
            });
        });

    </script>
    <div class="slide" id="slide">
        <ul>
            <li>
                <a href="#">
                    <img src="{{asset('images/1.jpg')}}" alt="">
                </a>

            </li>
            <li>
                <a href="#">
                    <img src="{{asset('images/2.jpg')}}" alt="">
                </a>

            </li>
            <li>
                <a href="#">
                    <img src="{{asset('images/3.jpg')}}" alt="">
                </a>

            </li>
            <li>
                <a href="#">
                    <img src="{{asset('images/4.jpg')}}" alt="">
                </a>

            </li>
        </ul>
        <div class="dot">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <hr style="height:0.3em;color:#EEEEEE;border:none;">
    <div class="weui_grids">
        <a href="javascript:;" class="weui_grid js_grid"  >
            <div class="weui_grid_icon"  >
                <img src="{{asset('images/hot.png')}}" alt="">
            </div>
            <p class="weui_grid_label">
                热门排行
            </p>
        </a>
        <a href="javascript:;" class="weui_grid js_grid" >
            <div class="weui_grid_icon">
                <img src="{{asset('images/people.png')}}" alt="">
            </div>
            <p class="weui_grid_label">
                人气排行
            </p>
        </a>
        <a href="{{url('all_cate')}}" class="weui_grid js_grid" >
            <div class="weui_grid_icon">
                <img src="{{asset('images/all.png')}}" alt="">
            </div>
            <p class="weui_grid_label">
                全部分类
            </p>
        </a>
    </div>
    <hr style="height:0.3em;color:#EEEEEE;border:none;">
    <div class="slide" id="slide1" style="background:#eee;height:1.5em;line-height:1.5em;rgba(0, 0, 0, 0.01);vertical-align:middle;margin:0 auto;font-size:0.8em;">
        <ul>
            <li>
                <div  class='txt'><img src="{{asset('images/news.png')}}">&nbsp;&nbsp;&nbsp;&nbsp;热议：世界各地的水果大比拼.</div>
            </li>
            <li>
                <div  class='txt'><img src="{{asset('images/news.png')}}">&nbsp;&nbsp;&nbsp;&nbsp;热议：论每天一个苹果的重要性</div>
            </li>
            <li>
                <div  class='txt'><img src="{{asset('images/news.png')}}">&nbsp;&nbsp;&nbsp;&nbsp;热议：今天你吃水果了吗？</div>
            </li>
        </ul>
    </div>
    <div class="me_list">
        <div  class="weui-border">
            <div class="me_info">
                <div class="me_title"><strong>[好货]</strong>新鲜的水果，每天一个，您值得拥有</div>
                <div class="price">￥10000</div>
            </div>
            <div class="me_name"><img src="{{asset('images/t1.jpg')}}" alt=""></div>
        </div>
        <div  class="weui-border">
            <div class="me_info">
                <div class="me_title"><strong>[好货]</strong>新鲜的水果，每天一个，您值得拥有</div>
                <div class="price">￥10000</div>
            </div>
            <div class="me_img"><img src="{{asset('images/t2.jpg')}}" alt=""></div>
        </div>
    </div>

@endsection
@section('footer')
        <div class="weui_tabbar">
            <a href="javascript:;" class="weui_tabbar_item weui_bar_item_on">
                <div class="weui_tabbar_icon">
                    <img src="{{asset('images/home.png')}}" alt="">
                </div>
                <p class="weui_tabbar_label">首页</p>
            </a>
            <a href="javascript:;" class="weui_tabbar_item">
                <div class="weui_tabbar_icon">
                    <img src="{{asset('images/car.png')}}" alt="">
                </div>
                <p class="weui_tabbar_label">购物车</p>
            </a>
            <a href="javascript:;" class="weui_tabbar_item">
                <div class="weui_tabbar_icon">
                    <img src="{{asset('images/me.png')}}" alt="">
                </div>
                <p class="weui_tabbar_label">我</p>
            </a>

        </div>
@endsection

