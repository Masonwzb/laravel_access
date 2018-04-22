<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <script type="text/javascript"  src="{{ asset('adminFile/indexFile/echarts.js') }}"></script>
    {{--引入echarts文件.--}}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>INSPINIA | Dashboard</title>
    {{--{{ asset('adminFile/indexFile/') }}--}}
    <link href="{{ asset('adminFile/indexFile/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminFile/indexFile/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('adminFile/indexFile/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('adminFile/indexFile/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ asset('adminFile/indexFile/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('adminFile/indexFile/css/style.css') }}" rel="stylesheet">

    {{--其他页面显示css位置--}}
    @section('css')

    @show

</head>

<body>

<div id="wrapper">

    {{--左侧导航栏 开始--}}
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">

            <ul class="nav metismenu" id="side-menu">

                {{--头部设置开始--}}
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        {{--管理员图像设置--}}
                        <span>
                            <img alt="image" class="img-circle" src="{{ asset('adminFile/indexFile/img/tx.jpg') }}" />
                        </span>

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">智能门禁</strong>
                             </span> <span class="text-muted text-xs block">管理员 <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            {{--<li class="divider"></li>--}}
                            <li><a href="{{url('admin/pass')}}">修改密码</a></li>
                            <li><a href="{{url('admin/quit')}}">注销</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        Access
                    </div>
                </li>
                {{--头部设置结束--}}

                {{--主导航栏开始--}}

                <li class="{{ Request::getPathInfo() == '/ac_user/index' ||Request::getPathInfo() == '/admin/com_admin'?  'active' : '' }}">
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="{{ Request::getPathInfo() == '/admin/com_admin' ?  'active' : '' }}"><a href="{{ url('admin/com_admin') }}">大楼管理员管理</a></li>
                        <li class="{{ Request::getPathInfo() == '/ac_user/index' ?  'active' : '' }}"><a href="{{ url('ac_user/index') }}">普通用户管理</a></li>
                    </ul>
                </li>

                <li class="{{ Request::getPathInfo() == '/admin/floor' ?  'active' : '' }}">
                    <a href="{{ url('admin/floor') }}"><i class="fa fa-university"></i> <span class="nav-label">大楼管理 </span></a>
                </li>

                <li class="{{ Request::getPathInfo() == '/admin/room' ?  'active' : '' }}">
                    <a href="{{ url('admin/room') }}"><i class="fa fa-codepen"></i> <span class="nav-label">节点管理</span></a>
                </li>

                <li class="{{ Request::getPathInfo() == '/permit/index' ?  'active' : '' }}">
                    <a href="{{url('permit/index') }}"><i class="fa fa-unlock-alt"></i> <span class="nav-label">权限管理</span><span class="pull-right label label-primary">SPECIAL</span></a>
                </li>

                <li class="{{ Request::getPathInfo() == '/ac_record/index' ?  'active' : '' }}">
                    <a href="{{ url('ac_record/index') }}"><i class="fa fa-address-book"></i> <span class="nav-label">出入记录 </span></a>
                </li>

                <li class="{{ Request::getPathInfo() == '/ac_record/text' ?  'active' : '' }}">
                    <a href="{{ url('ac_record/text') }}"><i class="fa fa-bar-chart"></i> <span class="nav-label">数据统计</span> <span class="label label-warning pull-right">NEW</span></a>
                </li>

                @section('nav')

                @show

                {{--主导航栏结束--}}
            </ul>

        </div>
    </nav>
    {{--左侧导航栏 结束--}}


    {{--中间内容 开始--}}
    <div id="page-wrapper" class="gray-bg dashbard-1">

        {{--顶部导航栏 开始--}}
        <div class="row border-bottom">

            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" action="{{ url('admin/index') }}">
                        <div class="form-group">
                            <input type="text" placeholder="请输入搜索内容" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>

                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">欢迎来到智能门禁管理后台</span>
                    </li>

                    <li>
                        <a href="{{url('admin/pass')}}">
                            <i class="fa fa-refresh"></i> 修改密码
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/quit')}}">
                            <i class="fa fa-sign-out"></i> 注销
                        </a>
                    </li>
                </ul>

            </nav>

        </div>
        {{--顶部导航栏 结束--}}


        {{--自定义内容 开始--}}
        @yield('content')
        {{--自定义内容 结束--}}

        {{--底部 开始--}}
        <div class="footer">
            <div>
                <strong>Copyright</strong> 智能门禁 &copy; 2018-2019
            </div>
        </div>
        {{--底部 结束--}}

    </div>
    {{--中间内容 结束--}}

</div>

{{--引入文件--}}

        <!-- Mainly scripts -->
<script src="{{ asset('adminFile/indexFile/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Flot -->
<script src="{{ asset('adminFile/indexFile/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/plugins/flot/jquery.flot.pie.js') }}"></script>

<!-- Peity -->
<script src="{{ asset('adminFile/indexFile/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/demo/peity-demo.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('adminFile/indexFile/js/inspinia.js') }}"></script>
<script src="{{ asset('adminFile/indexFile/js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('adminFile/indexFile/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ asset('adminFile/indexFile/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('adminFile/indexFile/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('adminFile/indexFile/js/demo/sparkline-demo.js') }}"></script>

<!-- ChartJS-->
<script src="{{ asset('adminFile/indexFile/js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ asset('adminFile/indexFile/js/plugins/toastr/toastr.min.js') }}"></script>

        <!--同步官网模板开始-->

{{--配置项 开始--}}
<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cogs fa-spin"></i>
        </div>
        <div class="skin-settings">
            <div class="title">配置
                <br>
                <small style="text-transform: none;font-weight: 400">
                    配置框设计用户演示目的，所有选项课通过代码获得。
                </small>
            </div>
            <div class="setings-item">
                    <span>
                        折叠菜单
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                        <label class="onoffswitch-label" for="collapsemenu">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        固定侧边栏
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedsidebar" class="onoffswitch-checkbox" id="fixedsidebar">
                        <label class="onoffswitch-label" for="fixedsidebar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        顶级导航栏
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                        <label class="onoffswitch-label" for="fixednavbar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        顶部导航栏V.2
                        <br>
                        <small>*主要布局</small>
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixednavbar2" class="onoffswitch-checkbox" id="fixednavbar2">
                        <label class="onoffswitch-label" for="fixednavbar2">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        盒子布局
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                        <label class="onoffswitch-label" for="boxedlayout">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                    <span>
                        固定页脚
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedfooter" class="onoffswitch-checkbox" id="fixedfooter">
                        <label class="onoffswitch-label" for="fixedfooter">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="title">换肤</div>
            <div class="setings-item default-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-0">
                            默认
                        </a>
                    </span>
            </div>
            <div class="setings-item blue-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            蓝色
                        </a>
                    </span>
            </div>
            <div class="setings-item yellow-skin">
                    <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            黄色
                        </a>
                    </span>
            </div>
            <div class="setings-item ultra-skin">
                    <span class="skin-name ">
                        <a href="#" class="md-skin">
                            绿色（没用）
                        </a>
                    </span>
            </div>
        </div>
    </div>
</div>
{{--配置项 结束--}}

{{--配置项javascript--}}
<script>
    // Config box

    // Enable/disable fixed top navbar
    $('#fixednavbar').click(function () {
        if ($('#fixednavbar').is(':checked')) {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav');
            $('#boxedlayout').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar", 'on');
            }
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $("body").removeClass('fixed-nav-basic');
            $('#fixednavbar2').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar", 'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar2", 'off');
            }
        }
    });

    // Enable/disable fixed top navbar
    $('#fixednavbar2').click(function () {
        if ($('#fixednavbar2').is(':checked')) {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav').addClass('fixed-nav-basic');
            $('#boxedlayout').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar2", 'on');
            }
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav').removeClass('fixed-nav-basic');
            $('#fixednavbar').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar2", 'off');
            }
            if (localStorageSupport) {
                localStorage.setItem("fixednavbar", 'off');
            }
        }
    });

    // Enable/disable fixed sidebar
    $('#fixedsidebar').click(function () {
        if ($('#fixedsidebar').is(':checked')) {
            $("body").addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });

            if (localStorageSupport) {
                localStorage.setItem("fixedsidebar", 'on');
            }
        } else {
            $('.sidebar-collapse').slimscroll({
                destroy: true
            });
            $('.sidebar-collapse').attr('style', '');
            $("body").removeClass('fixed-sidebar');

            if (localStorageSupport) {
                localStorage.setItem("fixedsidebar", 'off');
            }
        }
    });

    // Enable/disable collapse menu
    $('#collapsemenu').click(function () {
        if ($('#collapsemenu').is(':checked')) {
            $("body").addClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport) {
                localStorage.setItem("collapse_menu", 'on');
            }

        } else {
            $("body").removeClass('mini-navbar');
            SmoothlyMenu();

            if (localStorageSupport) {
                localStorage.setItem("collapse_menu", 'off');
            }
        }
    });

    // Enable/disable boxed layout
    $('#boxedlayout').click(function () {
        if ($('#boxedlayout').is(':checked')) {
            $("body").addClass('boxed-layout');
            $('#fixednavbar').prop('checked', false);
            $('#fixednavbar2').prop('checked', false);
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $("body").removeClass('fixed-nav-basic');
            $(".footer").removeClass('fixed');
            $('#fixedfooter').prop('checked', false);

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar", 'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixednavbar2", 'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixedfooter", 'off');
            }


            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'on');
            }
        } else {
            $("body").removeClass('boxed-layout');

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'off');
            }
        }
    });

    // Enable/disable fixed footer
    $('#fixedfooter').click(function () {
        if ($('#fixedfooter').is(':checked')) {
            $('#boxedlayout').prop('checked', false);
            $("body").removeClass('boxed-layout');
            $(".footer").addClass('fixed');

            if (localStorageSupport) {
                localStorage.setItem("boxedlayout", 'off');
            }

            if (localStorageSupport) {
                localStorage.setItem("fixedfooter", 'on');
            }
        } else {
            $(".footer").removeClass('fixed');

            if (localStorageSupport) {
                localStorage.setItem("fixedfooter", 'off');
            }
        }
    });

    // SKIN Select
    $('.spin-icon').click(function () {
        $(".theme-config-box").toggleClass("show");
    });

    // Default skin
    $('.s-skin-0').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
    });

    // Blue skin
    $('.s-skin-1').click(function () {
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-1");
    });

    // Inspinia ultra skin
    $('.s-skin-2').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-2");
    });

    // Yellow skin
    $('.s-skin-3').click(function () {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").addClass("skin-3");
    });

    if (localStorageSupport) {
        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var fixednavbar2 = localStorage.getItem("fixednavbar2");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");

        if (collapse == 'on') {
            $('#collapsemenu').prop('checked', 'checked')
        }
        if (fixedsidebar == 'on') {
            $('#fixedsidebar').prop('checked', 'checked')
        }
        if (fixednavbar == 'on') {
            $('#fixednavbar').prop('checked', 'checked')
        }
        if (fixednavbar2 == 'on') {
            $('#fixednavbar2').prop('checked', 'checked')
        }
        if (boxedlayout == 'on') {
            $('#boxedlayout').prop('checked', 'checked')
        }
        if (fixedfooter == 'on') {
            $('#fixedfooter').prop('checked', 'checked')
        }
    }
</script>
<!--同步官网模板结束-->

{{--其他页面显示Javascript位置--}}
@section('javascript')


@show

</body>
</html>
