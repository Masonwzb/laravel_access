@extends('layouts.admin')

@section('css')

    <link href="{{ asset('adminFile/indexFile/css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
@stop

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
                    <strong>添加权限</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    {{--引导栏结束--}}

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>所有表单元素 <small><!--<span class="label label-warning pull-right">添加失败</span>--></small></h5>
        </div>
        <div class="ibox-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label" >学号/教工号</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="Permit[user_id]" value="{{ isset(old('Permit')['user_id']) ? old('Permit')['user_id'] :''}}">
                    </div>
                    <div class="col-sm-2">
                        <p class="form-control-static text-danger">{{ $errors->first('Permit.user_id') }}
                            @if(Session::has('error'))
                                {{ Session::get('error') }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">大楼</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="floor" name="floor">
                            <option value="">选择大楼</option>
                            @foreach($floors as $floor)
                                <option value="{{$floor->floor_id}}" @if(old('floor')==$floor->floor_id) selected=""@endif >{{$floor->floor_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">教室</label>
                    <div class="col-sm-2">
                        <select class="form-control" id="room" name="Permit[room_id]">
                            <option value="">选择教室号</option>

                        @forelse($room as $r)
                            @if($r->floor_id==old('floor'))
                                @if($r->room_id==old('Permit')['room_id'])
                                <option value="{{$r->room_id}}"  selected="">{{$r->room_name}}</option>
                                   @else
                                        <option value="{{$r->room_id}}">{{$r->room_name}}</option>
                                    @endif
                                @endif
                        @empty
                        @endforelse
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <p class="form-control-static text-danger">{{ $errors->first('Permit.room_id') }}</p>
                    </div>

                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group"id="data_5">
                    <label class="col-sm-2 control-label">时间段</label>
                    <div class="col-sm-3">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="Permit[b_d_time]" value="{{ isset(old('Permit')['b_d_time']) ? old('Permit')['b_d_time'] :date("m/d/20y",time())}}">
                            <span class="input-group-addon">至</span>
                            <input type="text" class="input-sm form-control" name="Permit[e_d_time]" value="{{ isset(old('Permit')['e_d_time']) ? old('Permit')['e_d_time'] :date("m/d/20y",time())}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <p class="form-control-static text-danger">{{ $errors->first('Permit.b_d_time') }}</p>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">开始时间</label>
                    <div class="col-sm-1">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" value="{{ isset(old('Permit')['b_hm_time']) ? old('Permit')['b_hm_time'] :'00:00'}}" id="start_time" name="Permit[b_hm_time]">
                            <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <select class="form-control " id="start">
                            <option value="0">选择课时</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">午1</option>
                            <option value="6">午2</option>
                            <option value="7">5</option>
                            <option value="8">6</option>
                            <option value="9">7</option>
                            <option value="10">8</option>
                            <option value="11">9</option>
                            <option value="12">10</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <p class="form-control-static text-danger">{{ $errors->first('Permit.b_hm_time') }}</p>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">结束时间</label>
                    <div class="col-sm-1">
                        <div class="input-group clockpicker" data-autoclose="true">
                            <input type="text" class="form-control" value="{{ isset(old('Permit')['e_hm_time']) ? old('Permit')['e_hm_time'] :'24:00'}}" id="end_time" name="Permit[e_hm_time]">
                            <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <select class="form-control " id="end">
                            <option value="0">选择课时</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">午1</option>
                            <option value="6">午2</option>
                            <option value="7">5</option>
                            <option value="8">6</option>
                            <option value="9">7</option>
                            <option value="10">8</option>
                            <option value="11">9</option>
                            <option value="12">10</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <p class="form-control-static text-danger">{{ $errors->first('Permit.e_hm_time') }}</p>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white" type="reset">重置</button>
                        <button class="btn btn-primary" type="submit">立即提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
   @stop

@section('javascript')
    <script src="{{ asset('adminFile/indexFile/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('adminFile/indexFile/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('adminFile/indexFile/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('adminFile/indexFile/js/plugins/clockpicker/clockpicker.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.clockpicker').clockpicker();
            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });
            $("#floor").change(function(){
                //alert('fsdfsa');
                var floor = $("#floor").val();
                //alert(floor);
                if(floor=='')
                    return;

                $.ajax({
                    async:false,
                    url:"{{ url('permit/getRoom') }}",
                    data:{floor_id:floor,'_token':'{{ csrf_token() }}'},
                    type:"POST",
                    dataType:"json",
                    async: true,
                    success: function(data){
                        //alert(data);
                        var str='<option value="">选择教室号</option>';
                        $.each(data,function(i,result){
                            str+='<option value="'+result['room_id']+'">'+result['room_name']+'</option>';
                        });
                        //alert(str);
                        $("#room").html(str);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //layer.msg('请求异常', {icon: 2, time: 1000});
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    }
                });
            });
            $("#start").change(function(){
                var start = $("#start").val();
                //alert(floor);
                if(start==0)
                    return;

                var start_time=new Array("","08:00","08:55","10:00","10:55","12:30","13:25","14:30","15:25","16:30","17:25","19:30","20:25");

                $("#start_time").val(start_time[start]);
            });
            $("#end").change(function(){
                var end = $("#end").val();
                //alert(floor);
                if(end==0)
                    return;

                var end_time=new Array("","08:45","09:40","10:45","11:40","13:15","14:10","15:15","16:10","17:15","18:10","20:15","21:10");

                $("#end_time").val(end_time[end]);
            });
        });
    </script>
    <!-- Page-Level Scripts -->

@stop
