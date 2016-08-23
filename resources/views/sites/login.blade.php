@extends('app')

@section('head')

    <style type="text/css">

        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {

            max-width: 330px;
            padding:15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox{
            margin-bottom: 10px;
        }

        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>

@stop

@section('content')

    <div class="form-signin">

    {!! Form::open() !!}

        <h2 class="form-signin-heading" id="hitLabel">请登录</h2>
        {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'请输入用户名','maxlength'=>'20','required','autofocus']) !!}
        {!! Form::password('password',['class'=>'form-control','placeholder'=>'请输入密码','maxlength'=>'30','required']) !!}
        {!! Form::button("登录",['class'=>'btn btn-lg btn-primary btn-block','style'=>'margin-top: 30px;','type'=>'submit']) !!}
        {!! Form::button("注册",['class'=>'btn btn-lg btn-primary btn-block','style'=>'margin-top: 5px;','onclick'=>'goRegister()']) !!}
    {!! Form::close() !!}


        <ui class="list-group" >
            @if(!empty($backmsg))
                <li id="errorMsgLab" class="list-group-item list-group-item-danger" style="margin-top:5px;">{{$backmsg}}</li>
            @else
                <li id="errorMsgLab" class="list-group-item list-group-item-danger" style="margin-top:5px; display: none;"></l
            @endif
        </ui>

        @if($errors->any())
        <ui class="list-group">

            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger" style="margin-top:5px;">{{$error}}</li>
            @endforeach

        </ui>
        @endif

    </div>

@stop


@section('floor')

    <script>

        function goRegister() {

            window.location.href="register";
        }
        
        
    </script>
    
@stop