@extends('layouts.admin')

@section('content')

    {{--引导栏开始--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>用户管理向导</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin/index') }}">主页</a>
                </li>
                <li>
                    <a href="{{ url('ac_user/index') }}">用户管理</a>
                </li>
                <li class="active">
                    <strong>查看学生信息</strong>
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
                        <h5>查看学生信息</h5>
                    </div>
                    <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <td width="50%">ID</td>
                        <td>{{ $ac_user->user_id }}</td>
                    </tr>

                    <tr>
                        <td>卡号</td>
                        <td>{{ $ac_user->card_no }}</td>
                    </tr>

                    <tr>
                        <td>学号</td>
                        <td>{{ $ac_user->user_no }}</td>
                    </tr>

                    <tr>
                        <td>姓名</td>
                        <td>{{ $ac_user->user_name }}</td>
                    </tr>

                    <tr>
                        <td>电话</td>
                        <td>{{ $ac_user->tel }}</td>
                    </tr>

                    <tr>
                        <td>性别</td>
                        <td>{{ $ac_user->sex }}</td>
                    </tr>

                    <tr>
                        <td>权限</td>
                        <td>{{ $ac_user->permission }}</td>
                    </tr>

                    <tr>
                        <td>专业</td>
                        <td>{{ $ac_user->profession }}</td>
                    </tr>


                    </tbody>



                    </table>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10" >
                            <button class="btn btn-white" type="button"  onclick="javascript:history.back(-1);">返回</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>





@stop