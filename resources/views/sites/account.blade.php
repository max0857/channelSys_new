@extends('app')

@section('head')


    <style type="text/css">

        .form-signin {

            width: 400px;
            padding:15px;
            margin: 0 auto;
            float:left;
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

        .form-signin input[type="text"]{
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;

        }
        .form-signin input[type="email"]{
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;

        }
    </style>

@stop

@section('content')

    <div class="panel panel-default" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">我的资料</div>
        <div class="panel-body">

            <div class="form-signin">
                {!! Form::model($user,['url'=>'account/upuser']) !!}
                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'请输入姓名','maxlength'=>'20','required','autofocus']) !!}
                {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'请输入手机号','maxlength'=>'20','required']) !!}
                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'请输入邮箱','maxlength'=>'50','required']) !!}
                {!! Form::text('bankname',null,['id'=>'bankname','class'=>'form-control','placeholder'=>'请输入开户银行(例:建设银行)','maxlength'=>'50','required']) !!}
                {!! Form::text('bankaddress',null,['id'=>'bankaddress','class'=>'form-control','placeholder'=>'请输入开户支行(例:XX省XX市XX区XX支行)','maxlength'=>'100','required']) !!}
                {!! Form::text('accountname',null,['id'=>'accountname','class'=>'form-control','placeholder'=>'请输入银行户名(例:张三)','maxlength'=>'50','required']) !!}
                {!! Form::text('accountcode',null,['id'=>'accountcode','class'=>'form-control','placeholder'=>'请输入银行账号','maxlength'=>'50','required']) !!}

                <p style="font-size: medium; color: #d62728; margin-top: 10px;">银行信息保存后不能自行修改</p>

                <ui class="list-group" style="margin-top: 8px;">
                    @if(!empty($backmsg))
                        <li id="errorMsgLab" class="list-group-item list-group-item-danger" style="margin-top:5px;">{{$backmsg}}</li>
                    @else
                        <li id="errorMsgLab" class="list-group-item list-group-item-danger" style="margin-top:5px; display: none;"></li>
                    @endif
                </ui>

                {!! Form::button("保存",['class'=>'btn btn-sm btn-primary','style'=>'margin-top: 30px;','type'=>'submit']) !!}

                {!! Form::close() !!}
            </div>
        </div>

    </div>

    <div class="panel panel-default" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">申请提现</div>
        <div class="panel-body">

            <p style="font-size: medium; color: #d62728; margin-top: 10px;">当前账户余额为:{{$sum}}元</p>
            <p style="font-size: medium; color: #d62728; margin-top: 10px;">当前可申请提现金额为:{{$can}}元</p>
            <div class="form-signin">
                {!! Form::open(['url'=>'account/withdraw']) !!}
                {!! Form::number('money',null,['id'=>'money','class'=>'form-control','placeholder'=>'请输入提现金额','maxlength'=>'20','required','autofocus']) !!}

                <ui class="list-group" style="margin-top: 8px;">
                    @if(!empty($backmsg2))
                        <li id="errorMsgLab" class="list-group-item list-group-item-danger" style="margin-top:5px;">{{$backmsg2}}</li>
                    @else
                        <li id="errorMsgLab" class="list-group-item list-group-item-danger" style="margin-top:5px; display: none;"></li>
                    @endif
                </ui>

                @if($errors->any())
                    <ui class="list-group" id="emsg2">

                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger" style="margin-top:5px;">{{$error}}</li>
                        @endforeach

                    </ui>
                @endif

                {!! Form::button("确定",['class'=>'btn btn-sm btn-primary','style'=>'margin-top: 30px;','type'=>'submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>

    </div>

    <div class="panel panel-default" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">提现记录</div>
        <div class="panel-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    @foreach($titles as $index=>$title)
                        <th>{{$title}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($withdraws as $index=>$item)
                    <tr>
                        <td>{{$item->bank_name}}</td>
                        <td>{{$item->accountcode}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->money/100}}元</td>
                        <td>{{$item->status==1?'已打款':'打款中'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@stop


@section('floor')

    <script>

        $(document).ready(function(){

            if($("#bankname").val()!=""){
                $("#bankname").attr("readonly","readonly");
            }

            if($("#accountcode").val()!=""){
                $("#accountcode").attr("readonly","readonly");
            }

            if($("#accountname").val()!=""){
                $("#accountname").attr("readonly","readonly");
            }

            if($("#bankaddress").val()!=""){
                $("#bankaddress").attr("readonly","readonly");
            }

            $("#money").change(function(){
                if($(this).val()<0) $(this).val(0);

                if($(this).val()>{{$can}})  $(this).val({{$can}});

            });


        });

    </script>


@stop