@extends('admin.master')
@section('title','产品列表')

@section('content')
    <div style="">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="page-container">
            <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="product_add('添加分类','/admin/add_cate')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th width="40"><input name="" type="checkbox" value=""></th>
                        <th width="40">编号</th>
                        <th width="40">类别</th>
                        <th width="40">父类</th>

                        <th width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cates as$k=>$cate)
                    <tr class="text-c va-m">
                        <td><input name="" type="checkbox" value=""></td>
                        <td>{{$k+1}}</td>
                        <td>{{$cate->cate_name}}</td>
                        <td>@if($cate->parent!='')
                            {{$cate->parent->cate_name}}
                            @endif</td>

                        <td class="td-manage"><a style="text-decoration:none" class="ml-5" onClick='category_edit({{$cate->cate_id}})' href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                            <a style="text-decoration:none" class="ml-5" onClick='category_del({{$cate->cate_id}})' href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        function product_add(title,url){
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
        function category_edit(id){
            var title ='产品种类编辑';
            var url='editCate/cate_id/'+id;
            var w ='';
            var h= 510;
            layer_show(title,url,w,h);
        }
        function category_del(cate_id){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    type: 'GET',
                    url: 'delCate/cate_id/'+ cate_id,
                    dataType: 'json',
                    success: function(data){
                        if (data == null) {
                            layer.msg('服务端错误', {icon: 2, time: 2000});
                            return;
                        }
                        if (data.status != 0) {
                            layer.msg(data.messages, {icon: 2, time: 2000});
                            return;
                        }

                        layer.msg(data.messages,{icon:1,time:2000});
                        location.reload();
                    },
                    error:function(data) {
                        console.log(data.msg);
                    },
                });

            });
        }
    </script>
@endsection
