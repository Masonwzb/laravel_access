@extends('layouts.admin')

@section('content')

    {{--引导栏开始--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>出入记录向导</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin/index') }}">主页</a>
                </li>
                <li class="active">
                    <a href="{{ url('ac_record/index') }}"><strong>出入记录</strong></a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    {{--引导栏结束--}}

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>出入记录</h5>

                    </div>
                    <div class="ibox-content">
        <table class="footable table table-stripped" data-page-size="10" data-filter=#filter>

            <div class="col-sm-3 col-sm-offset-3">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" id="filter"
                           placeholder="请输入搜索内容"></div>
            </div>
            <thead>
            <tr>
                <th>记录id</th>
                <th>学号</th>
                <th>姓名</th>
                <th>教室</th>
                <th>进入时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ac_records as $ac_record)
                <tr>
                    <th scope="row">{{ $ac_record ->record_id }}</th>
                    <td>{{ $ac_record ->ac_user->user_no }}</td>
                    <td>{{ $ac_record ->ac_user->user_name }}</td>
                    <td>{{ $ac_record ->ac_room->room_name }}</td>
                    <td>{{ $ac_record ->record_time }}</td>
                    <td>
                        <a type="button" href="javascript:delRecord({{$ac_record->record_id}})" class="btn-xs btn-white">删除</a>
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



@stop
@section('javascript')
    <link href="{{ asset('adminFile/indexFile/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <script src="{{ asset('adminFile/indexFile/js/plugins/footable/footable.all.min.js')}}"></script>
    {{--layer弹窗--}}
    <script type="text/javascript" src="{{ asset('layer/layer.js') }}"></script>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        function delRecord(record_id)
        {
            layer.confirm('您确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.ajax({
                    async:false,
                    url:"{{ url('ac_record/delete') }}/"+record_id,
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


        });
    </script>
@stop