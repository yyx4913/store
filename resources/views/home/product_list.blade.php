@extends('home/master')
@section('title','商品列表')
@section('js')
    <script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('js/swipe.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    <div class="weui_cells_title" style="margin-top:0em;">水果列表</div>
    @foreach($products as $product)
        <div class="weui_cells weui_cells_access">
            <a class="weui_cell " href="{{url('product_content/p_id/'.$product->id)}}">
                <div class="weui_cell_hd" ><img src="{{$product->preview}}"></div>
                <div class="weui_cell_bd weui_cell_primary" style="padding-left:0.65em;">
                    <p style="color:red; float:right;">￥{{$product->price}}</p>
                    <p class="bk_title">{{$product->name}}</p>
                    <p class="bk_summary">{{$product->summary}}</p>
                </div>
            </a>
        </div>
            @endforeach
@endsection

@section('footer')
    <div class="weui_tabbar">
        <a href="{{url('all_cate')}}" class="weui_tabbar_item weui_bar_item_on">
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

