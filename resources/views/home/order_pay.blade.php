@extends('home/master')
@section('title','订单结算')
@section('js')
    <script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('js/swipe.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    @if($car_items !=null)
        @foreach($car_items as $car_item)
            <div class="weui_cells" style="padding:0.6em;">
                <div class="weui_cell_bd weui_cell_primary" style="width:50%;float:right;">
                    <p class="bk_title">{{$car_item->product->name}}</p>
                    <p style="color:red;">数量：{{$car_item->product->price*$car_item->count}}&nbsp;×&nbsp;{{$car_item->count}}</p>
                </div>
                <div class="car_img" ><img src="{{$car_item->product->preview}}"></div>
            </div>
        @endforeach
        @endif
        <div class="weui_cells_title" style="margin-top:0em;">支付方式</div>
        <div class="weui_cells">
        <div class="weui_cell_bd weui_cell_primary">
            <select class="weui_select" name="pay_way">
                <option value="bao">支付宝支付</option>
                <option value="xin">微信支付</option>
            </select>
        </div>
    </div>
    <div class="weui_cells">
        <div class="weui_cell_bd weui_cell_primary"  style="padding:0.65em;">
            <div style="float:right;color:red;">￥{{$price}}&nbsp;&nbsp;&nbsp;</div>总计：
        </div>
    </div>

@endsection

@section('footer')
        <div class="weui_tabbar" >
            <button style="margin:0.5em;" href="javascript:;" class="weui_btn weui_btn_primary">提交支付</button>
        </div>
@endsection

