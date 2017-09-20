@extends('admin.master')
@section('title','添加分类')
@section('content')
    <article class="page-container">
        <form class="form form-horizontal" id="form-category-add">
            {{csrf_field()}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级类别：</label>
                <div class="formControls col-xs-2 col-sm-2">
                    <select class="select" size="1" name="p_name">
                        @foreach($cates as $cate)
                            @if($cate->cate_id ==$category->p_id)
                                <option value="{{$cate->cate_id}}"  selected="selected" >{{$cate->cate_name}}</option>
                            @else
                                <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>种类名称：：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$category->cate_name}}" placeholder="不能为空"  name="cate_name">
                    <input type="hidden" value="{{$category->cate_id}}" name="cate_id">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>编号：</label>
                <div class="formControls col-xs-4 col-sm-3">
                    <input type="text" class="input-text" value="{{$category->cate_order}}" name="cate_order">
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>
@endsection

@section('footer')

    <script type="text/javascript">
        $(function() {
            $("#form-category-add").validate({
                rules: {

                    cate_name: {
                        required: true,
                    },
                    cate_id: {
                        required: true,

                    },
                },
                onkeyup: false,
                focusCleanup: true,
                success: "valid",
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        url: '/admin/editCateinfo',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            p_name: $('input[name=p_name]').val(),
                            cate_name: $('input[name=cate_name]').val(),
                            cate_order: $('input[name=cate_order]').val(),
                            cate_id :$('input[name=cate_id]').val(),
                        },
                        success: function (data) {
                            if (data == null) {
                                layer.msg('服务端错误', {icon: 2, time: 2000});
                                return;
                            }
                            if (data.status != 0) {
                                layer.msg(data.messages, {icon: 2, time: 2000});
                                return;
                            }
                            layer.msg(data.messages, {icon: 1, time:2000});
                            parent.location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                        }
                    });
//                    var index = parent.layer.getFrameIndex(window.name);
//                    parent.$('.btn-refresh').click();
//                    parent.layer.close(index);
                }
            });
            return false;
        });
    </script>
    @endsection