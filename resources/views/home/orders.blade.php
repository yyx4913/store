@extends('home/master')
@section('title','订单查询')
@section('js')
    <script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('js/swipe.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    @if($orders !=null)
        @foreach($orders as $order)

            <div class="weui_cells_title"><span style="color:red;float:right">&nbsp;未支付</span>订单号:{{$order->order_num}}</div>
            @foreach($order->order_items as $item)
            <div class="weui_cells" style="padding:0.6em;margin:0px;">
                <div style="float:right;font-size:0.1em;margin-top:0.85em;">￥ {{$item->product->price*$item->count}}&nbsp;×&nbsp;{{$item->count}}</div>
                <div class="car_img" ><img src="{{$item->product->preview}}"> &nbsp;&nbsp;&nbsp;&nbsp;{{$item->product->name}}</div>
            </div>
            @endforeach
            <br/>
            <p style="float:right;margin-right:1em;font-size:0.95em;" >总计：<span style="color:red;">&nbsp;{{$order->count}}</span>&nbsp;件</p>
        @endforeach
    @endif
@endsection

@section('footer')
        <div class="weui_tabbar" >
            <button style="margin:0.5em;" href="javascript:;" onclick="_toCharge()" class="weui_btn weui_btn_primary">去支付</button>
        </div>
        <script>
            function _toCharge(){
                location.href='/carinfo';
            }
        </script>
@endsection


