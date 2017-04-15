<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Admin\AdminUser;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("admin.login");
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
        if(Session::get('code') != $request->code){
            return view("404")->with('info','验证码错误...')->with('url','/admin/login');
        }
        //接收参数
        $data = \Input::all();
        if(empty($data['name']) || empty($data['password'])) back();
        //实例化Model
        $user = new AdminUser();
        $adminUserInfo = $user->getAdminUserInfo($data['name']);
        //判断用户是否存在
        if (empty($adminUserInfo)) back();
        //转数组
        $adminUserInfo = $adminUserInfo->toArray();
        //加密密码
        $password = md5($data['password']);
        if ($adminUserInfo['password'] == $password){
            \Session::put('login',$adminUserInfo);
            $datas['login_time'] = time();
            $datas['login_ip'] = $request->getClientIp();
            AdminUser::updateAdminUser($adminUserInfo['id'],$datas);
            return redirect('/index');
        }else{
            return view("errors.503")->with('info','密码好像有错误...');
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

    // 验证码生成
    public function captcha($tmp)
    {
        $phrase= new PhraseBuilder;
        $code=$phrase->build(4);
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code,$phrase);
        //设置背景颜色
        $builder->setBackgroundColor(220,220,220);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        // dd($phrase);
        //把内容存入session
        Session::flash('code', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }


    public function logout(){
        \Session::forget('login');
        return redirect('/admin/login');
    }

}
