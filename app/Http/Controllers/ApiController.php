<?php

namespace App\Http\Controllers;

use App\Business;
use App\Channel;
use App\Rule;
use App\Stream;
use App\UserProduct;
use App\users;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function  bmobnotice(Request $request){



        if(Business::where('order_id','=',$request['out_trade_no'])->count()>0){
            exit('succeed');
        }


//        echo 'test';
//        dd($request);
        $client= new Client(
            ['headers' =>
                [
                    'X-Bmob-Application-Id' => '8298940d99f1d17d9ec88a1611d5e53e',
                    'X-Bmob-REST-API-Key'=>'4908b60a29f3eccddd8ad716dd5ae892'
                ]
            ]);

        $promise=$client->requestAsync('GET','https://api.bmob.cn/1/pay/'.$request['out_trade_no']);
//        $promise=$client->requestAsync('GET','https://api.bmob.cn/1/pay/6f5ff2a767246594a65a742eb9651212');
        $promise->then(function ($response) {

            $code = $response->getStatusCode();
            if($code==200){
//                echo $response->getBody();
                $bodyString = (string)$response->getBody();
                $data= json_decode($bodyString,true);

                $business=new Business();
                $business->name=$data['name'];
                $business->detailed=$data['body'];
                $business->turnover=$data['total_fee']*100;//单位分
                if($data['trade_state']=='SUCCESS')
                    $business->status=1;
                $business->type='bmob:'.$data['pay_type'];
                $business->order_id=$data['out_trade_no'];


//                $data['body']='test|1|4';

                

                $arr=explode('|',$data['body']);
                if(count($arr)>=3) {
                    $product_id = $arr[1];
                    $channel_id = $arr[2];
                    $data['product_id']=$product_id;
                    $data['channel_id']=$channel_id;
                    $business->product_id = $product_id;
                    $business->channel_id = $channel_id;
                }

                $business->save();
                $data['business_id']=$business->id;

                if(!empty($data['channel_id'])) {
                    $this->createStream($data);
                }

            }else{
                echo $response->getBody();
            }


        });

        $promise->wait();
        exit('succeed');

    }

    public function createStream($data){

        $channel=Channel::where('id','=',$data['channel_id'])->first();
        $own_id=$channel->own_id;
        $user=users::where('id',$own_id)->first();

        $rule_id=UserProduct::where('user_id','=',$own_id)->where('product_id','=',$data['product_id'])->first()->rule_id;
        $rule=Rule::where('id','=',$rule_id)->first();


        $stream=new Stream;
        $stream->own_id=$own_id;
        $stream->terminal_id=$own_id;
        $stream->opt='sr';
        $stream->money=$data['total_fee']*100;
        $stream->share=$data['total_fee']*100*((float)$rule->scale/100);
        $stream->rule_image=json_encode($rule);
        $stream->status=1;
        $stream->product_id=$data['product_id'];
        $stream->channel_id=$data['channel_id'];
        $stream->business_id=$data['business_id'];

        $stream->save();

        if($user->farter_id!=0) {

            $f_stream = new Stream;
            $f_stream->own_id = $user->farter_id;
            $f_stream->terminal_id = $own_id;
            $f_stream->opt = 'fc';
            $f_stream->money = $data['total_fee'] * 100;
            $f_stream->share = $data['total_fee'] * 100 * ((float)(100 - $rule->scale) / 100);
            $f_stream->rule_image = json_encode($rule);
            $f_stream->status = 1;
            $f_stream->product_id = $data['product_id'];
            $f_stream->channel_id = $data['channel_id'];
            $f_stream->business_id = $data['business_id'];

            $f_stream->save();
        }

    }
}
