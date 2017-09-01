<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //定义一个表名
    protected $table = 'user';
    //定义主键
    protected $primaryKey = 'user_id';
    //时间设置
    public $timestamps = false;

    /**
     * 获取分页用户列表
     * @param $skip 起始位置
     * @param $number 获取条数
     * @return bool
     */
    public static function getUserList($skip,$number)
    {
        //接收验证参数
        if (!numericValue($skip) || !numericValue($number)) return false;
        //查询数据库
        $listUser = self::skip($skip)->take($number)->orderBy('reg_time', 'desc')->where('status',0)->get();
        if($listUser){
            return $listUser;
        }else{
            return false;
        }
    }

    /**
     * 所有文章数量
     * @return bool
     */
    public static function getCount()
    {
        $count = self::where('status',0)->count();
        if ($count) {
            return $count;
        } else {
            return false;
        }
    }

    /**
     * 获取所有用户列表
     */
    public static function getAllList()
    {
        //查询数据库
        $allUser = self::where('status',0)->orderBy('reg_time', 'desc')->get();
        if($allUser){
            return $allUser;
        }else{
            return false;
        }
    }

    /**
     * 获取指定id用户
     */
    public static function getUser($user_id)
    {
        //接收验证参数
        if (empty($user_id)) return false;
        //查询数据库
        $user = self::where('user_id',$user_id)->first();
        if($user){
            return $user;
        }else{
            return false;
        }
    }

    /**
     * 修改个人用户
     * @param $user_id
     * @param $param
     * @return bool
     */
    public static function updateUser($user_id,$param)
    {
        //接收验证参数
        if (empty($user_id) || empty($param)) return false;
        $res = self::where('user_id', $user_id)->update($param);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除用户
     * @param $user_id
     * @return bool
     */
    public static function deleteUser($user_id)
    {
        //接收验证参数
        if ( empty($user_id) ) return false;
        $res = self::where('user_id', $user_id)->update(['status' =>1]);
        if ($res) {
            return true;
        } else {
            return false;
        }

    }

}
