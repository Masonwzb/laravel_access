@extends('layouts.admin')

@section('content')

    {{--引导栏开始--}}
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>数据统计向导</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('admin/index') }}">主页</a>
                </li>
                <li class="active">
                    <a href="{{ url('ac_record/index') }}"><strong>数据统计</strong></a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    {{--引导栏结束--}}

    <div id="main" style="height:800px;"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '出入次数'
            },//标题
            toolbox:{
                show:true,
                feature:{
                    magicType : {
                        show: true, type: ['line', 'bar']
                    },
                    restore : {
                        show: true
                    },
                    saveAsImage:{
                        show:true
                    }
                }
            },
            tooltip: {},
            legend: {
                data:['次数']
            },
            xAxis: {
                data: ["SWE15045","SWE15038","CME15064","SWE15011","SWE15050"]
            },
            yAxis: {},
            series: [{
                name: '次数',
                type: 'bar',
                data: [5, 2, 3, 1, 1]
            }
            ]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>



@stop
@section('javascript')
    <link href="{{ asset('adminFile/indexFile/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <script src="{{ asset('adminFile/indexFile/js/plugins/footable/footable.all.min.js')}}"></script>
    <script>

        $(document).ready(function(){
            $('.footable').footable();
            $('.footable2').footable();


        });
    </script>
@stop