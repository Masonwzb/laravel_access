@extends('layouts.admin')

@section('content')

    {{--引导栏开始--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>大楼管理员管理向导</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">主页</a>
                </li>
                <li>
                    <a href="{{ url('admin/com_admin') }}">大楼管理员管理</a>
                </li>
                <li class="active">
                    <strong>添加大楼管理员</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    {{--引导栏结束--}}

    {{--添加com_admin开始--}}
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-10">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>添加大楼管理员</h5>
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

                <form class="form-horizontal" method="post" action="{{ url('admin/com_admin') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-lg-2 control-label">普通管理员名称：</label>
                        <div class="col-md-5">
                             <input type="text" placeholder="请输入名称" value="{{ old('admin_name') }}" name="admin_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">密码：</label>
                        <div class="col-md-5">
                        <input type="password" placeholder="请输入密码" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">确认密码：</label>
                        <div class="col-md-5">
                        <input type="password" placeholder="请确认密码" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input type="button" class="btn btn-white" onclick="history.go(-1)" value="返回">
                            <button class="btn btn-primary" type="submit">提交添加</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
      </div>
    </div>
</div>
    {{--添加com_admin结束--}}

@stop

@section('javascript')



@stop