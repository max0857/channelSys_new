@extends('app')

@section('head')


@stop

@section('content')

    <div class="panel panel-default" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">我的下线</div>
        <div class="panel-body">
            <p>我的下线</p>
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
            @foreach($items as $index=>$item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->level}}</td>
                    <td>{{$item->paycount}}</td>
                    <td>{{$item->businessValue}}</td>
                    <td>{{$item->share}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop


@section('floor')



@stop