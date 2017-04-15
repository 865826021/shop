<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Tools\Common;

class RbacController extends Controller
{

    public function __construct()
    {
        $this->Common = new Common();
    }

    /**
     *角色列表
     */
    public function rbacRole()
    {
        $RoleList = DB::table('role')->get();
        $RoleList = $this->Common->objectToArray($RoleList);
        //dd($RoleList);
        return view("admin.rbac.rbacrole")->with('RoleList',$RoleList);
    }

    /**
     *添加角色
     */
    public function addRole()
    {
        return view("admin.rbac.addrole");
    }
    /**
     *添加角色表单处理
     */
    public function addRoleStore(Request $request)
    {
        $input = \Input::except('_token');
        //dd($input);
        $this->validate($request , [
            'name'=>'required|unique:role',
            'remark'=>'required'
        ],
            [
                'name.required'=>'角色名称必须填写!',
                'name.unique'=>'角色名称已存在!',
                'remark.required'=>'角色描述必须填写!'
            ]
        );
        $data['name'] = $input['name'];
        $data['remark'] = $input['remark'];
        $data['status'] = $input['status'];
        $re = DB::table('role')->insert($data);
        if($re){
            return redirect('/rbacRole');
        }else{
            return view("404")->with('info','添加失败...')->with('url','/addRbacRole');
        }
    }

    /**
     *节点列表
     */
    public function rbacNode()
    {
        $NodeList = DB::table('node')->get();
        $NodeList = $this->Common->objectToArray($NodeList);
        //dd($NodeList);
        return view("admin.rbac.rbacnode")->with('NodeList',$NodeList);
    }

    /**
     *添加节点
     */
    public function addNode()
    {
        $node = DB::table('node')->whereIn('level', [1, 2])->get();
        $node = $this->Common->objectToArray($node);
        foreach($node as $k=>$v){
            if($v['level']==2){
                $node[$k]['title'] = "----".$v['title'];
            }
        }
        //dd($node);
        return view("admin.rbac.addnode")->with('node',$node);
    }
    /**
     *添加角色表单处理
     */
    public function addNodeStore(Request $request)
    {
        $input = \Input::except('_token');
        //dd($input);
        $this->validate($request , [
            'name'=>'required|unique:node',
            'title'=>'required'
        ],
            [
                'name.required'=>'应用名称必须填写!',
                'name.unique'=>'应用名称已存在!',
                'title.required'=>'应用描述必须填写!'
            ]
        );
        $data['name'] = $input['name'];
        $data['title'] = $input['title'];
        $data['status'] = $input['status'];
        $data['sort'] = $input['sort'];
        $data['pid'] = $input['pid'];
        $level = DB::table('node')->where('id','=',$data['pid'])->get();
        $level = $this->Common->objectToArray($level);
        //dd($level);
        $data['level'] = $level[0]['level']+1;
        //dd($data);
        $re = DB::table('node')->insert($data);
        if($re){
            return redirect('/rbacNode');
        }else{
            return view("404")->with('info','添加失败...')->with('url','/addRbacNode');
        }
    }

    /**
     *权限
     */
    public function access($role_id)
    {
        //dd($role_id);
        $NodeList = DB::table('node')->get();
        $NodeList = $this->Common->objectToArray($NodeList);
        //$NodeList = $this->Common->node_merge($NodeList);
        //dd($NodeList);
        $access = DB::table('access')->where('role_id','=',$role_id)->lists('node_id');;
        //dd($access);
        $NodeList = $this->Common->node_merge_access($NodeList,$access);
        //dd($NodeList);
        return view("admin.rbac.access")->with('NodeList',$NodeList)->with('role_id',$role_id);
    }

    public function setAccess(Request $request)
    {
        $input = \Input::except('_token');
        //dd($input);
        $role_id = $input['role_id'];
        //删除原权限
        DB::table('access')->where('role_id','=',$role_id)->delete();
        //组合新权限
        $data = array();
        foreach($input['access'] as $v){
            $tmp = explode('_',$v);
            //dd($tmp);
            $data[] = array(
                'role_id' => $role_id,
                'node_id' => $tmp[0],
                'level' => $tmp[1]
            );
            //dd($data);
        }
        //dd($data);
        //写入数据库
        $re = DB::table('access')->insert($data);
        if($re){
            return redirect('/rbacRole');
        }else{
            return view("404")->with('info','添加失败...')->with('url','/rbacRole');
        }
    }

    /**
     *管理员用户列表
     */
    public function rbacUser()
    {
        $UserList = DB::table('admin_user')->get();
        $UserList = $this->Common->objectToArray($UserList);
        //dd($UserList);
        $RoleList = DB::table('role')->get();
        $RoleList = $this->Common->objectToArray($RoleList);
        foreach($UserList as $k=>$v){
            foreach($RoleList as $r){
                if($v['role_id'] == $r['id']){
                    $UserList[$k]['role'] = $r['remark'];
                }
            }
        }
        //dd($UserList);
        return view("admin.rbac.rbacuser")->with('UserList',$UserList);
    }

    /**
     *添加后台管理员
     */
    public function addUser()
    {
        $RoleList = DB::table('role')->get();
        $RoleList = $this->Common->objectToArray($RoleList);
        return view("admin.rbac.adduser")->with('RoleList',$RoleList);
    }

    /**
     *添加后台管理员表单处理
     */
    public function addUserStore(Request $request)
    {
        $input = \Input::except('_token');
        //dd($input);
        $this->validate($request , [
            'name'=>'required|unique:admin_user',
            'password'=>'required|min:3'
        ],
            [
                'name.required'=>'管理员名称必须填写!',
                'name.unique'=>'管理员名称已存在!',
                'password.required'=>'管理员密码必须填写!',
                'password.min'=>'密码最小三位!'
            ]
        );
        $data['name'] = $input['name'];
        $data['password'] = md5($input['password']);
        $data['role_id'] = $input['role_id'];
        $re = DB::table('admin_user')->insert($data);
        if($re){
            return redirect('/rbacUser');
        }else{
            return view("404")->with('info','添加失败...')->with('url','/addUser');
        }
    }

}
