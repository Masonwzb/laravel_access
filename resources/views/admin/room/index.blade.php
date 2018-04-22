@extends('layouts.admin')

@section('css')

        <!-- FooTable -->
<link href="{{ asset('adminFile/indexFile/css/plugins/footable/footable.core.css')}}" rel="stylesheet">

@stop

@section('content')


    {{--引导栏开始--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>节点管理向导</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin/index') }}">主页</a>
                </li>
                <li>
                    <a href="{{ url('admin/room') }}">节点管理</a>
                </li>
                <li class="active">
                    <strong>节点列表</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    {{--引导栏结束--}}

    {{--com_room列表显示开始--}}
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>全部节点</h5>

                </div>
                <div class="ibox-content">

                    {{--消息提示开始--}}
                    @if(count($errors)>0)
                        @if(is_object($errors))

                            @foreach($errors->all() as $msgs)

                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ $msgs }}
                                </div>

                            @endforeach

                        @else

                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                {{ $errors }}
                            </div>

                        @endif
                    @endif
                    {{--消息提示结束--}}


                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">搜索：</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                       placeholder="请输入搜索内容">
                            </div>
                            <div class="col-sm-5">
                                <div class="pull-right">
                                    <a  class="btn btn-w-m btn-primary" href="{{ url('admin/room/create') }}">添加节点</a>
                                </div>
                            </div>
                        </div>
                    </form>


                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>节点名称</th>
                            <th>节点状态</th>
                            <th>大楼名称</th>
                            <th>更新时间</th>
                            <th>连接状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $v)
                            <tr>
                                <td>{{ $v->room_name }}</td>
                                <td>{{ $v->room_status }}</td>
                                <td>
                                    @foreach($fields as $f)

                                        @if($v->floor_id == $f->floor_id)
                                            {{ $f->floor_name }}
                                        @endif

                                    @endforeach
                                </td>
                                <td>{{ $v->room_time }}</td>
                                <td>
                                    @if($v->room_status == 1)
                                        <span class="label label-primary">已连接</span>
                                    @else
                                        <span class="label label-danger">未连接</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" href="{{ url('admin/room/'.$v->room_id.'/edit') }}" class="btn btn-white btn-xs">编辑</a>
                                        <a type="button" href="javascript:;" onclick="delRoom({{ $v->room_id }})" class="btn btn-white btn-xs">删除</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    {{--com_room列表显示结束--}}


    @stop



    @section('javascript')

            <!-- FooTable -->
    <script src="{{ asset('adminFile/indexFile/js/plugins/footable/footable.all.min.js')}}"></script>
    {{--layer弹窗--}}
    <script type="text/javascript" src="{{ asset('layer/layer.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });

    </script>

    {{--删除友情链接--}}
    <script>
        function delRoom(room_id)
        {
            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{ url('admin/room') }}/"+room_id,{ '_method':'delete','_token':'{{ csrf_token() }}' },function(data){

                    if(data.status == 1)
                    {
                        layer.msg(data.msg,{ icon:6 });
                        location.href = location.href;
                    }else{
                        layer.msg(data.msg,{ icon:5 });
                    }

                });
//                alert(cate_id);
//              layer.msg('的确很重要', {icon: 1});
            }, function(){
//              layer.msg('也可以这样', {
//                   time: 20000, //20s后自动关闭
//                       btn: ['明白了', '知道了']
//              });
            });

        }
    </script>

@stop