<?php

namespace App\Http\Controllers;

use App\Channel;
use App\RegisterCode;
use App\users;
use Illuminate\Http\Request;


use App\Http\Requests;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sites.register');
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
    public function store(Requests\RegisterRequest $request)
    {


//        $this->validate($request,['username'=>'required|min:6']);

        $input=$request->all();
//        unset($input['repassword']);
//        $input['password']=bcrypt($input['password']);
//        dd($input);


        $user=new users;
        $user->username=$input['username'];
        $user->password=bcrypt($input['password']);
        $t= users::checkUsername($input['username'])->get();
        if($t->count()!=0){
//            dd('用户已存在');
//            return back()->withErrors(['用户名已存在'],'errors');
            return view('sites.register',['backmsg'=>'用户已存在']);
        }

        $rCode= RegisterCode::where('code','=',$input['registerCode'])->get();
        if($rCode->count()==0){
            return view('sites.register',['backmsg'=>'邀请码错误']);
        }

        if($rCode[0]->status==1){
            return view('sites.register',['backmsg'=>'这个邀请码已用过']);
        }

        $user->farter_id= $rCode[0]->own;

        $user->join_ip=$request->ip();

        $rCode[0]->status=1;
        $rCode[0]->save();

        if($user->save()){

            $channel=new Channel;
            $channel->own_id=$user->id;
            $channel->channel_name='default';
            $channel->detailed='每个账户的默认渠道';
            if($channel->save()){
                return redirect('login');
            }
        }
        return view('sites.register',['backmsg'=>'系统出错,请联系管理员']);
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
}
