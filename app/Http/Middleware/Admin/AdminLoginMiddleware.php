<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Tools\Common;

class AdminLoginMiddleware
{
    public function __construct()
    {
        $this->Common = new Common();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle($request, Closure $next)
//    {
//        //读取SESSON值作为判断
//        $adminUserInfo = \Session::get('login');
//        //dd($adminUserInfo);
//        //权限验证
//        $NodeList = DB::table('access')->where('role_id','=',$adminUserInfo['role_id'])->get();
//        $NodeList = $this->Common->objectToArray($NodeList);
//        //dd($NodeList);
//        //echo $_SERVER['REQUEST_URI'];
//        $data = array('/','/index','/admin/logout','/admin/login');
//        foreach($NodeList as $n){
//            //dd($n);
//            $NodeList = DB::table('node')->where('id','=',$n['node_id'])->get();
//            $NodeList = $this->Common->objectToArray($NodeList);
//            //dd($NodeList);
//            $data[] = $NodeList[0]['name'];
//        }
//        //dd($data);
//
//        if($adminUserInfo && $data){
//            $access = $_SERVER['REQUEST_URI'];
//            if(in_array($access,$data)){
//                return $next($request);
//            }else{
//                return view("404")->with('info','暂无权限！！！')->with('url','/');
//            }
//        }else{
//            return redirect('/admin/login');
//        }
//    }

    public function handle($request, Closure $next)
    {
        //读取SESSON值作为判断
        $adminUserInfo = \Session::get('login');
        //dd($adminUserInfo);
        //权限验证
        $NodeList = DB::table('access')->where('role_id','=',$adminUserInfo['role_id'])->get();
        $NodeList = $this->Common->objectToArray($NodeList);
        //dd($NodeList);
        //echo $_SERVER['REQUEST_URI'];
        $data = array('/','/index','/admin/logout','/admin/login');
        foreach($NodeList as $n){
            //dd($n);
            $NodeList = DB::table('node')->where('id','=',$n['node_id'])->get();
            $NodeList = $this->Common->objectToArray($NodeList);
            //dd($NodeList);
            $data[] = $NodeList[0]['name'];
        }
        //dd($data);

        if($adminUserInfo && $data){
            $access = $_SERVER['REQUEST_URI'];
            //dd($access);
            $access_1 = explode('/',$access);
            //dd($access_1);
            foreach($access_1 as $k=>$v){
                //dd($a);
                if(is_numeric($v)){
                    unset($access_1[$k]);
                }
            }
            //dd($access_1);
            $access = implode('/',$access_1);
            //dd($access);
            if(in_array($access,$data)){
                return $next($request);
            }else{
                return view("404")->with('info','暂无权限！！！')->with('url','/');
            }
        }else{
            return redirect('/admin/login');
        }
    }

//    public function handle($request, Closure $next)
//    {
//        //读取SESSON值作为判断
//        $adminUserInfo = \Session::get('login');
//        //dd($adminUserInfo);
//        if($adminUserInfo){
//            return $next($request);
//        }else{
//            return redirect('/admin/login');
//        }
//    }

}
