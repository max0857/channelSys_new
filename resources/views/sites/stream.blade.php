@extends('app')

@section('head')


@stop

@section('content')

    <div class="panel panel-default" style="margin-top: 20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">收入流水</div>
        <div class="panel-body">
            <p>我的渠道</p>
        </div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
            <tr>

                @foreach($titles as $index=>$title)
                    <th>{{$title}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            {{--$titles=['产品','渠道','类型','金额','发生时间'];--}}
            @foreach($data as $index=>$item)
                <tr>
                    <td>{{$item['appname']}}</td>
                    <td>{{$item['channelname']}}</td>
                    <td>{{$item['type']}}</td>
                    <td>{{$item['menoy']}}</td>
                    <td>{{$item['time']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $streams->appends([])->render() !!}
    </div>

@stop


@section('floor')



@stop