@extends('app')

@section('head')

    <style>
        .account-stat{overflow:hidden; color:#666;}
        .account-stat .account-stat-btn{width:100%; overflow:hidden;}
        .account-stat .account-stat-btn > div{text-align:center; margin-bottom:5px;margin-right:2%; float:left;width:23%; height:80px; padding-top:10px;font-size:16px; border-left:1px #DDD solid;}
        .account-stat .account-stat-btn > div:first-child{border-left:0;}
        .account-stat .account-stat-btn > div span{display:block; font-size:30px; font-weight:bold}
    </style>


@stop

@section('content')

    <div class="panel panel-default" style="margin-top: 20px;">
    <div class="panel-heading">
        今日关键指标
    </div>
    <div class="account-stat">
        <div class="account-stat-btn">
            <div>今日收益<span>{{$data['today_sr']}}</span></div>
            <div>今日分成<span>{{$data['today_fc']}}</span></div>
            <div>今日总收益<span>{{$data['today_sum']}}</span></div>
            <div>历史总收益<span>{{$data['sum']}}</span></div>
        </div>
    </div>
</div>

@stop


@section('floor')



@stop