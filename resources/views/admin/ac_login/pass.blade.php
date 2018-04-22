@extends('layouts.admin')
@section('content')

    {{--引导栏开始--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>修改密码向导</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin/index') }}">主页</a>
                </li>
                <li class="active">
                    <a href="{{ url('admin/pass') }}"><strong>修改密码</strong></a>
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
                        <h5>修改密码</h5>
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

                        <form class="form-horizontal" method="post" action="">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-lg-2 control-label">原密码：</label>
                                <div class="col-md-5">
                                    <input type="password" placeholder="请输入原密码" name="password_o" class="form-control">
                                </div>
                                <label class="col-lg-2 control-label"> 请输入原始密码  </label>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">密码：</label>
                                <div class="col-md-5">
                                    <input type="password" placeholder="请输入密码" name="password" class="form-control">
                                </div>
                                <label class="col-lg-2 control-label"> 新密码6-20位  </label>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">确认密码：</label>
                                <div class="col-md-5">
                                    <input type="password" placeholder="请确认密码" name="password_confirmation" class="form-control">
                                </div>
                                <label class="col-lg-2 control-label"> 再次输入密码 </label>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type="submit" class="btn btn-primary" value="确定修改">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--添加com_admin结束--}}



{{--<div class="result_wrap">--}}
    {{--<form method="post" action="">--}}
        {{--{{csrf_field()}}--}}
        {{--<table class="add_tab">--}}
            {{--<tbody>--}}
            {{--<tr>--}}
                {{--<th width="120"><i class="require">*</i>原密码：</th>--}}
                {{--<td>--}}
                    {{--<input type="password" name="password_o"> </i>请输入原始密码</span>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th><i class="require">*</i>新密码：</th>--}}
                {{--<td>--}}
                    {{--<input type="password" name="password"> </i>新密码6-20位</span>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th><i class="require">*</i>确认密码：</th>--}}
                {{--<td>--}}
                    {{--<input type="password" name="password_confirmation"> </i>再次输入密码</span>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<th></th>--}}
                {{--<td>--}}
                    {{--<input type="submit" value="提交">--}}
                    {{--<input type="button" onclick="history.go(-1)" value="返回">--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</form>--}}
{{--</div>--}}


@endsection