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

        {!! Form::open(['onsubmit'=>'return checkFrom();']) !!}

        <h2 class="form-signin-heading" id="hitLabel">注册新用户</h2>
        {!! Form::text('username',null,['id'=>'username','class'=>'form-control','placeholder'=>'请输入用户名','maxlength'=>'20','required','autofocus']) !!}
        {!! Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'请输入密码','maxlength'=>'30','required']) !!}
        {!! Form::password('repassword',['id'=>'repassword','class'=>'form-control','placeholder'=>'请输入密码','maxlength'=>'30','required']) !!}
        {!! Form::text('registerCode',null,['id'=>'registerCode','class'=>'form-control','placeholder'=>'请输入邀请码','maxlength'=>'30','required']) !!}
        {!! Form::button("注册",['class'=>'btn btn-lg btn-primary btn-block','style'=>'margin-top: 30px;','type'=>'submit']) !!}
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

        function checkFrom() {

            var username=$("#username").val();
            var pass1=$("#password").val();
            var pass2=$("#repassword").val();

            var hitLab=$("#errorMsgLab");


            if(username.length<6){

                hitLab.show();
                hitLab.text("用户名至少6位");
                return false;
            }

            if(pass1.length<8){
                hitLab.show();
                hitLab.text("密码至少8位");
                return false;
            }
            if(pass1 != pass2){
                hitLab.show();
                hitLab.text("密码不一致");
                return false;
            }
            return true;
        }


    </script>

@stop