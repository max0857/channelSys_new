@extends('app')

@section('head')


@stop

@section('content')

    <div class="panel panel-default" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">我的渠道</div>
        <div class="panel-body">
            <p>我的渠道</p>
        </div>

        <!-- Table -->
        <table class="table table-striped">
            <caption>条纹表格布局</caption>
            <thead>
            <tr>
                @foreach($titles as $index=>$title)
                    <th>{{$title}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($channels as $index=>$item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->channel_name}}</td>
                    <td>{{$item->detailed}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop


@section('floor')



@stop