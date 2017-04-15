<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin\User;
use App\Tools\CustomPage;

class UserController extends Controller
{
    public $number =  PAGESIZE;    //每页显示条数

    public function __construct()
    {
        $this->CustomPage = new CustomPage();
    }

    /*
     * 注册用户分页列表
     */
    public function index(Request $request)
    {
        $nowPage = $request->input('nowPage')?$request->input('nowPage'):1;
        $number = $this->number;
        $skip = ($nowPage-1)*$number;
        $UserList = User::getUserList($skip,$number)->toArray();
        $count = User::getCount();
        $totalPage=ceil($count/$number);
        $baseUrl=url('/user');
        $pageView=$this->CustomPage->getSelfPageView($nowPage,$totalPage,$baseUrl,[]);
        return view('admin.user.index')->with('pageView',$pageView)->with('UserList',$UserList);
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
    public function edit($user_id)
    {
        //echo "edit";die();
        $data = User::getUser($user_id)->toArray();
        //dd($data);
        return view('admin.user.update')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //echo "update";die();
        $input = \Input::except('_token');
        //dd($input);
        $user_id = $input['user_id'];
        //dd($user_id);
        $data['user_name'] = $input['user_name'];
        $data['user_pwd'] = $input['user_pwd'];
        $data['user_phone'] = $input['user_phone'];
        $data['user_email'] = $input['user_email'];
        $data['publish'] = $input['publish'];
        $res = User::updateUser($user_id , $data);
        if ($res) {
            return redirect('/user');
        } else {
            $data = User::getUser($user_id);
            //dd($data);
            return view('admin.user.update')->with('data',$data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $res = User::deleteUser($user_id);
        if ($res) {
            return redirect('/user');
        } else {
            return view("404")->with('info','用户删除失败...')->with('url','/user');
        }
    }
}
