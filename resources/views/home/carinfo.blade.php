@extends('home/master')
@section('title','购物车')
@section('js')
    <script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('js/swipe.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    <div class="weui_cells_title" style="margin-top:0em;">购物车</div>
    @if($car_items !=null)
    @foreach($car_items as $car_item)
        <div class="weui_cells weui_cells_checkbox">
            <label class="weui_cell weui_check_label" for="{{$car_item->pro_id}}">
                <div class="weui_cell_hd">
                    <input type="checkbox" class="weui_check" name="car_item" id="{{$car_item->pro_id}}"
                          value="{{$car_item->pro_id}}" checked="checked">
                    <i class="weui_icon_checked"></i>
                </div>
                <div class="weui_cell_bd weui_cell_primary">
                    <div class="weui_cell_bd weui_cell_primary" style="width:60%;float:right;">

                        <p class="bk_title">{{$car_item->product->name}}</p>
                        <p class="bk_summary">数量：×&nbsp;{{$car_item->count}}</p>
                        <p style="color:red;">总计：{{$car_item->product->price*$car_item->count}}</p>
                    </div>
                    <div class="weui_cell_hd" style="width:35%;"><img src="{{$car_item->product->preview}}"></div>

                </div>
            </label>
        </div>
    @endforeach
    @else
        <div style="margin:35%;"><img src="{{asset('images/hehe.png')}}">,购物车为空哦~~</div>
    @endif
@endsection

@section('footer')
    <div class="weui_tabbar" style="padding:0.3em;background-color: #F0F0F0;">
        <button onclick="_toCharge()" class="weui_btn weui_btn_primary"style="margin-right:1em;">结算</button>
        <button onclick="_delCar()" class="weui_btn weui_btn_default" >删除</button>
    </div>

@endsection
@section('my-js')
    <script src="{{asset('js/home.js')}}"></script>
    @endsection

