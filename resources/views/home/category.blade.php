@extends('home/master')
@section('title','类别')
@section('js')
    <script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('js/swipe.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
@section('content')
    <div class="weui_cells_title">选择水果种类</div>
    <div class="weui_cells">
        <div class="weui_cell_bd weui_cell_primary">
            <select class="weui_select" name="cate">

                @foreach($categorys as $category)
                <option value="{{$category->cate_id}}">{{$category->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="weui_cells weui_cells_access">
        <div class="weui_cells_title">推荐水果</div>
        @foreach($fruits as $fruit)
            <a class="weui_cell " href="{{url('product_list/cate_id/'.$fruit->cate_id)}}">
                <div class="weui_cell_bd weui_cell_primary">
                    <p>{{$fruit->cate_name}}</p>
                </div>
                <div class="weui_cell_ft">说明文字</div>
            </a>
        @endforeach
    </div>

    <script type="text/javascript">
        $('.weui_select').change(function(event){
            var p_id=$('.weui_select option:selected').val();

            getCate(p_id);
        });

    </script>
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

