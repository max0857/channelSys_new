<?php

namespace App\Http\Controllers;

use App\users;
use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $users=users::all();
//        return $users;
        return view('sites.login');
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
    public function store(Requests\LoginRequest $request)
    {
//        dd($request);

//        $this->validate($request,['username'=>'required|min:6']);

        $input=$request->all();
//        users::create($input);

        if(Auth::attempt([
            'username'=>$input['username'],
            'password'=>$input['password'],
        ])){
//            return 'succees';

            users::where('username',$input['username'])
                ->update(['last_ip'=>$request->ip()]);


            return redirect('/');
        }else{
            return view('sites.login',['backmsg'=>'账号或密码错误']);
//            return redirect()->intended('home');
        }

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
