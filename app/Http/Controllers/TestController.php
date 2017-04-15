<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use iscms\Alisms\SendsmsPusher as Sms;
use DB;
use Crypt;
use Storage;
use Hash;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $sms;

    public function __construct(Sms $sms)
    {

        $this->sms=$sms;

    }

    public function index()
    {
        //
        $datas=DB::table('admin_user')->get();
        $datas=json_encode($datas);  //数组转换json
        print_r($datas);
        echo "<br/>";
        $datas=json_decode($datas);  //json转换数组
        print_r($datas);
        echo "<br/>";
        $str='asdfasdfasdf';
        $secret=Crypt::encrypt($str);  //加密
        echo $secret;
        echo "<br/>";
        $decrypt = Crypt::decrypt($secret);  //解密
        echo $decrypt;
        echo "<br/>";
        //Storage::disk('local')->put('file.txt', 'Contents');  //存储Contents内容到storage/app/file.txt
        $hash="123456789";
        $hashedword=Hash::make($hash);
        echo $hashedword;
        echo "<br/>";
        if (Hash::check($hash, $hashedword)) {
            echo "哈希密码匹配!";
        }
        else{
            echo "哈希密码不匹配!";
        }
        echo "<br/>";
        $random = str_random(6);
        echo $random;
        echo "<br/>";
        $token = csrf_token();
        echo $token;
        echo "<br/>";

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
        echo '22222222222';
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
        echo '33333';
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
    public function fasongcode()
    {
        $tel=15824802030;
        //发送验证码
        $num = rand(100000,999999);
        $smsParams = [
            'code'    => "$num",
            'product' => '【平台】'
        ];
        $name = '注册验证';
        $content = json_encode($smsParams);
        $code = 'SMS_9205003';
        $data=$this->sms->send("$tel","$name","$content","$code");
        if(property_exists($data,'result')){
            echo 'success';
            dd($data);
            exit();
        }else{
            echo 'failed';
            dd($data);
            exit();
        }
    }
}
