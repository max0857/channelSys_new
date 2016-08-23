@extends('app')

@section('head')


@stop

@section('content')

    <div class="panel panel-default" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">我的产品</div>
        <div class="panel-body">
            <p>我的产品</p>
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
            @foreach($data as $index=>$item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->app_name}}</td>
                    <td>{{$item->identification}}</td>
                    <td>{{$item->detailed}}</td>
                    <td>{{$item->version_code}}</td>
                    <td>{{$item['scale']}}%</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop


@section('floor')



@stop