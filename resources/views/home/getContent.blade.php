@extends('home/master')
@section('title','信息列表')
@section('js')
    <script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('js/swipe.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    <script>
        $(function() {
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
        });
    </script>
    @if(!$imgs ->isEmpty())
    <div  id="slide" class="slide">
        <ul>
            @foreach($imgs as $img)
                <li>
                    <a href="">
                        <img src="{{$img->pro_path}}" alt="">
                    </a>
                    <div class="slide-desc"></div>
                </li>
            @endforeach

        </ul>
        <div class="dot" style="right: 10px;">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    @endif
        <div class="weui_cells weui_cells_access" style="margin-top:0em;">
            <a class="weui_cell " href="">
                <div class="weui_cell_hd" ><img src=""></div>
                <div class="weui_cell_bd weui_cell_primary" style="padding-left:0.65em;">
                    <p style="color:red; float:right;">￥{{$product->price}}</p>
                    <p class="bk_title">{{$product->name}}</p>
                    <p class="bk_summary">{{$product->summary}}</p>
                </div>
            </a>
        </div>
        <div class="weui_cells_title">详细信息介绍</div>
        @if($content !=null)
        <div class="weui_cells weui_cells_access">
            {!! $content->content !!}
        </div>
        @endif
@endsection

@section('footer')
    <div class="weui_tabbar" style="padding:0.45em;background-color: #F0F0F0;">
        <button onclick="_addCar({{$product->id}})" class="weui_btn weui_btn_primary"style="margin-right:1em;">加入购物车</button>
        <button onclick="toCar()" class="weui_btn weui_btn_default" >查看购物车(<div id="num" style="display:inline;">{{$count}}</div>)</button>
    </div>
@endsection
@section('my-js')
    <script src="{{asset('js/home.js')}}"></script>
    <script type="text/javascript">
        function toCar()
        {
            location.href='/carinfo';
        }
    </script>
@endsection

