@extends('app')

@section('head')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<link rel="stylesheet" href="http://v3.bootcss.com/examples/dashboard/dashboard.css">--}}

    <style>

        body{

            padding-top: 50px;

        }

        .sidebar {
            display: none;
        }
        @media (min-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top:0;
                height:800px;
                z-index: 1000;
                display: block;
                /*padding-bottom: 100%;*/
                /*padding: 20px;*/
                overflow-x: hidden;
                overflow-y: hidden; /* Scrollable contents if viewport is shorter than content. */
                background-color: #f5f5f5;
                border-right: 1px solid #eee;
            }
        }

        .main{
            position: fixed;
            height:100%;
            overflow-x: hidden;
            overflow-y: hidden;
            /*padding-bottom: 100%;*/


        }

        .nav-sidebar {
            margin-right: -21px; /* 20px padding + 1px border */
            /*margin-bottom: 20px;*/
            margin-left: -20px;
        }
        .nav-sidebar > li > a {
            padding-right: 20px;
            padding-left: 20px;
        }
        .nav-sidebar > .active > a,
        .nav-sidebar > .active > a:hover,
        .nav-sidebar > .active > a:focus {
            color: #fff;
            background-color: #428bca;
        }

    </style>

@stop

@section('content')

    <nav class="navbr navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">渠道管理系统</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li style="display: none;"><a href="#">控制台</a></li>
                    <li style="display: none;"><a href="#">设置</a></li>
                    <li style="display: none;"><a href="#">偏好</a></li>
                    <li ><a href="logout">登出</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 col-sm-3 sidebar">

                <ul class="nav nav-sidebar" id="nav_side_ui">
                    <li class="active" value="brief"><a href="#">概况</a></li>
                    <li value="product"><a href="#">我的产品</a></li>
                    <li value="channel"><a href="#">我的渠道</a></li>
                    <li value="subline"><a href="#">我的下线</a></li>
                    <li value="account"><a href="#">我的账户</a></li>
                    <li value="stream"><a href="#">收入流水</a></li>
                </ul>

            </div>

            <div class="col-md-10 col-sm-9 main" >
                <iframe id="frame" src="brief" frameborder="0" height="100%" width="100%" scrolling="auto"></iframe>
            </div>


        </div>

    </div>


@stop


@section('floor')


    <script>

        $(document).ready(function(){

            $('#nav_side_ui li a').click(function(){
                $('#nav_side_ui li').removeClass('active');
                $(this).parent().addClass('active');

                $("#frame").attr("src",$(this).parent().attr("value"));

            })

        });
    </script>

@stop