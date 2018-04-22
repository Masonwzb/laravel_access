@extends('layouts.admin')

@section('content')

    {{--引导栏开始--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>权限管理向导</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin/index') }}">主页</a>
                </li>
                <li>
                    <a href="{{ url('permit/index') }}">权限管理</a>
                </li>
                <li class="active">
                    <strong>权限管理列表</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    {{--引导栏结束--}}



    <div class="wrapper wrapper-content animated fadeInRight">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>权限管理<!--<span class="label label-primary pull-right">添加成功</span>--> </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4 m-b-xs">
                                <a class="btn btn-sm btn-primary" href="{{ url('permit/create') }}">添加权限</a>
                            </div>
                            <!--<div class="col-sm-2 m-b-xs">
                                <select class="form-control" id="floor">
                                    <option value="">选择大楼</option>
                                    @foreach($floors as $floor)
                                        <option value="{{$floor->floor_id}}">{{$floor->floor_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-sm-2 m-b-xs">
                                <select class="form-control" id="room">
                                    <option value="0">选择教室号</option>

                                </select>

                            </div>-->
                            <div class="col-sm-3 col-sm-offset-3">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" id="filter"
                                           placeholder="请输入搜索内容"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                <thead>
                                <tr>
                                    <th>权限编号</th>
                                    <th>学号 </th>
                                    <th>姓名</th>
                                    <th>大楼</th>
                                    <th>教室</th>
                                    <th>时间段</th>
                                    <th>起止时间</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permits as $permit)
                                <tr>
                                    <td>{{ $permit->per_id }}</td>
                                    <td>{{ $permit->user->user_no }}</td>
                                    <td>{{ $permit->user->user_name }}</td>
                                    <td>{{ $permit->room->floor_name }}</td>
                                    <td>{{ $permit->room->room_name }}</td>
                                    <td>{{ $permit->b_d_time }}至{{ $permit->e_d_time }} </td>
                                    <td>{{ $permit->b_hm_time }}至{{ $permit->e_hm_time }}</td>
                                    <td>{{ $permit->create_at }}</td>
                                    <td>
                                        <a href="{{url('permit/update',['id'=>$permit->per_id])}}" class="btn btn-primary btn-sm">编辑</a>
                                        <a href="javascript:delPermit({{$permit->per_id}})" class="btn btn-danger btn-sm">删除</a>
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
    </div>
@stop

@section('javascript')
    <script src="{{ asset('adminFile/indexFile/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('adminFile/indexFile/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminFile/indexFile/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('adminFile/indexFile/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('adminFile/indexFile/js/plugins/peity/jquery.peity.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('adminFile/indexFile/js/inspinia.js') }}"></script>
    <script src="{{ asset('adminFile/indexFile/js/plugins/pace/pace.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('adminFile/indexFile/js/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('adminFile/indexFile/js/demo/peity-demo.js') }}"></script>

    <link href="{{ asset('adminFile/indexFile/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <script src="{{ asset('adminFile/indexFile/js/plugins/footable/footable.all.min.js')}}"></script>
    {{--layer弹窗--}}
    <script type="text/javascript" src="{{ asset('layer/layer.js') }}"></script>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        function delPermit(per_id)
        {
            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.ajax({
                    async:false,
                    url:"{{ url('permit/delete') }}/"+per_id,
                    type:"POST",
                    data: {'_token':'{{ csrf_token() }}'},
                    dataType:"json",
                    async: true,
                    success: function(data){
                        if(data.status == 1)
                        {
                            layer.msg(data.msg,{ icon:6 });
                            setTimeout(function () {
                                location.href = location.href;
                            }, 2000);

                        }else{
                            layer.msg(data.msg,{ icon:5 });
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //layer.msg('请求异常', {icon: 2, time: 1000});
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
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
        $(document).ready(function(){
            $('.footable').footable();
            $('.footable2').footable();
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });


        });
    </script>
    <!-- Page-Level Scripts -->

@stop
