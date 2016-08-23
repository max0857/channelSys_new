<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Product;
use App\Rule;
use App\Stream;
use App\UserProduct;
use App\users;
use App\Withdraw;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Auth::check()) {
           echo "非法访问";
        }
//        dd(Auth::user());

//        $tt=new RegisterCode();
//        $tt->own=1;
//        $tt->status=1;
//        $tt->code='test';
//        $tt->save();
        return view('sites.home');
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
//        Auth::logout();
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

    public function logout(){
        Auth::logout();
    }

    public function brief(){

        $userid=Auth::user()['id'];
        $streams=Stream::where('own_id','=',$userid)
            ->where('opt','!=','tx')
            ->where('status',1);

        $data=array();
        $data['sum']=sprintf('%0.2f',$streams->sum('share')/100);

        $streams=$streams->where('updated_at','>=',Carbon::today());

        $data['today_sum']=sprintf('%0.2f',$streams->sum('share')/100);

        $t1=clone $streams;

        $t=$streams->where('opt','=','fc');

        $data['today_fc']=sprintf('%0.2f',$t->sum('share')/100);

        $t1=$t1->where('opt','=','sr');

        $data['today_sr']=sprintf('%0.2f',$t1->sum('share')/100);

        return view('sites.brief',compact('data'));
    }

    public function channel(){
        $userid=Auth::user()['id'];
        $channels = Channel::where('own_id','=',$userid)->get();
        $titles=['渠道id','渠道名','详情'];
        return view('sites.channel',compact('channels','titles'));
    }

    public function product(){

        $userid=Auth::user()['id'];
        $my_products=UserProduct::where('user_id','=',$userid)->get();
        $titles=['产品id','产品名','产品标识','详情','版本号','分成比例'];
        $data=array();
        foreach ($my_products as $p){
            $pid=$p['product_id'];
            $rule_id=$p['rule_id'];

            $scale= Rule::where('id','=',$rule_id)->first()->scale;

            $product=Product::where('id','=',$pid)->first();
            $product['scale']=$scale;
            array_push($data,$product);
        }

//        dd($data);

        return view('sites.product',compact('titles','data'));
    }

    public function account($backmsg="",$backmsg2=""){

        $userid=Auth::user()['id'];
        $user= users::where('id','=',$userid)->first();

        $myStreams= Stream::where('own_id','=',$userid);
        $sum=$myStreams->sum('share');

        $tStreams=clone $myStreams;
        $tStreams=$tStreams->where("updated_at",'<',Carbon::today());

        $myStreams->where('opt','=','tx')->where("updated_at",'>=',Carbon::today());

        $can=sprintf('%0.2f',($tStreams->sum('share')+$myStreams->sum('share'))/100);
        $sum=sprintf('%0.2f',$sum/100);


        $titles=['提现银行','提现账号','提现时间','提现金额','状态'];
        $withdraws=  Withdraw::where('own_id','=',$userid)->get();



        return view('sites.account',compact('user','sum','can','backmsg','backmsg2','withdraws','titles'));
    }

    public function subline(){

        $userid=Auth::user()['id'];
        $items=users::where('farter_id', $userid)->get();

        $titles=['姓名','用户名','手机','权限级别','成交量','成交额','分成'];
        foreach ($items as &$u){

            $uid=$u['id'];
            $streams=Stream::where('own_id',$uid)->where('opt','!=','tx')->where('status',1);

            $u['paycount']=$streams->count();
            $u['businessValue']=$streams->sum('money');
            $u['share']=$streams->sum('share');
        }

//        dd($subline);

        return view('sites.subline',compact('titles','items'));
    }

    public function stream(){
        $userid=Auth::user()['id'];
        $user= users::where('id','=',$userid);
        $titles=['产品','渠道','类型','金额','发生时间'];
        $streams= Stream::where('own_id','=',$userid)->orderBy('created_at', 'desc')
            ->paginate(15);
        $streams->setPath('stream');

        $data=array();

        foreach ($streams as $stream){

            $item['type']=$stream->opt=='tx'?'提现':($stream->opt=='fc'?'分成':'收入');
            $item['menoy']=$stream->share/100;
            $item['time']=$stream->created_at;
            if($stream->opt!='tx') {
                $item['appname'] = Product::where('id','=',$stream->product_id)->first()->app_name;
                $item['channelname']=Channel::where('id','=',$stream->channel_id)->first()->channel_name;

            }else{
                $item['appname'] ="null";
                $item['channelname']="null";
            }

            array_push($data,$item);
        }


        return view('sites.stream',compact('streams','titles','data'));
    }

    public function  upuser(Requests\UpUserinfoRequest $request){

        $userid=Auth::user()['id'];
        $user= users::where('id','=',$userid);

        $t=clone $user;
        if($t->first()->bankname==""){
            $user->update([
                'bankname'=>$request['bankname'],
                'accountname'=>$request['accountname'],
                'accountcode'=>$request['accountcode'],
                'bankaddress'=>$request['bankaddress']
            ]);
        }

        $user->update(['name'=>$request['name'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
        ]);

        return $this->account();
    }


    public function withdraw(Request $request){



        $this->validate($request,['money'=>'required|numeric|max:100000']);

        if($request->money<100){
            $msg="至少提现100元";

            return $this->account('',$msg);
        }

        $userid=Auth::user()['id'];
        $user= users::where('id','=',$userid)->first();

        if($user->accountcode==''){
            $msg="需要先完善银行信息才能提现";
            return $this->account('',$msg);
        }

        $myStreams= Stream::where('own_id','=',$userid);

        $tStreams=clone $myStreams;
        $tStreams=$tStreams->where("updated_at",'<',Carbon::today());

        $myStreams->where('opt','=','tx')->where("updated_at",'>=',Carbon::today());

        $can=($tStreams->sum('share')+$myStreams->sum('share'));
        if($can/100<$request->money){
            $msg="您现在不可以提现这么多";
            return $this->account('',$msg);
        }






        $withdraw=new Withdraw;
        $withdraw->own_id=$userid;
        $withdraw->account_name=$user->accountname;
        $withdraw->accountcode=$user->accountcode;
        $withdraw->bank_name=$user->bankname;
        $withdraw->money=$request->money*100;
        $withdraw->status=0;

        $withdraw->save();


        $stream=new Stream;
        $stream->own_id=$userid;
        $stream->terminal_id=$userid;
        $stream->opt='tx';
        $stream->money=-($request->money*100);
        $stream->share=-($request->money*100);
        $stream->status=0;
        $stream->withdraw_id=$withdraw->id;

        $stream->save();

        return $this->account();
//        dd($request->money);

    }


}
