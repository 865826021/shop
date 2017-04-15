<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    //定义一个表名
    protected $table = 'admin_user';
    //定义主键
    protected $primaryKey = 'id';
    //时间设置
    public $timestamps = false;

    public function getAdminUserInfo($name)
    {
        $adminUserInfo = $this->where(array('name'=>$name))->first();
        return $adminUserInfo;
    }

    /**
     * 修改管理员
     * @param $id
     * @param $param
     * @return bool
     */
    public static function updateAdminUser($id,$param)
    {
        //接收验证参数
        if (empty($id) || empty($param)) return false;
        $res = self::where('id', $id)->update($param);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取指定id管理员
     * @param $id
     * @return bool
     */
    public static function getAdminUser($id){
        //接收验证参数
        if (empty($id)) return false;
        //查询数据库
        $AdminUser = self::where('id' , $id)->first();
        if($AdminUser){
            return $AdminUser;
        }else{
            return false;
        }
    }

}
