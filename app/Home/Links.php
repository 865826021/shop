<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table='links';
    protected $primaryKey='link_id';
    public $timestamps=false;

    /**
     * 获取分页链接列表
     * @param $skip 起始位置
     * @param $number 获取条数
     * @return bool
     */
    public static function getLinksList($skip,$number)
    {
        //接收验证参数
        if (!numericValue($skip) || !numericValue($number)) return false;
        //查询数据库
        $listUser = self::skip($skip)->take($number)->orderBy('add_time', 'desc')->where('status',0)->get();
        if($listUser){
            return $listUser;
        }else{
            return false;
        }
    }

    /**
     * 所有链接数量
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
     * 获取友情链接列表
     * @return bool
     */
    public static function getList(){
        //查询数据库
        $LinksList = self::get();
        if($LinksList){
            return $LinksList;
        }else{
            return false;
        }
    }

    /**
     * 获取指定id链接内容
     * @param $link_id
     * @return bool
     */
    public static function getLink($link_id){
        //接收验证参数
        if (empty($link_id)) return false;
        //查询数据库
        $link = self::where('link_id' , $link_id)->first();
        if($link){
            return $link;
        }else{
            return false;
        }
    }

    /**
     * 添加链接
     * @param array $param
     * @return bool
     */
    public static function insertLink(array $param = [])
    {
        if (empty($param)) return false;
        return parent::insert($param);
    }

    /**
     * 修改链接
     * @param $link_id
     * @param $param
     * @return bool
     */
    public static function updateLink($link_id,$param)
    {
        //接收验证参数
        if (empty($link_id) || empty($param)) return false;
        $res = self::where('link_id', $link_id)->update($param);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除链接
     * @param $link_id
     * @return bool
     */
    public static function deleteLink($link_id)
    {
        //接收验证参数
        if ( empty($link_id) ) return false;
        $res = self::where('link_id', $link_id)->update(['status' =>1]);
        if ($res) {
            return true;
        } else {
            return false;
        }

    }

}
