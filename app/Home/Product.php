<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //定义一个表名
    protected $table = 'product';
    //定义主键
    protected $primaryKey = 'id';
    //时间设置
    public $timestamps = false;

    /**
     * 获取文章列表
     * @param $skip 起始位置
     * @param $number 获取条数
     * @return bool
     */
    public static function getArticleList($skip,$number)
    {
        //接收验证参数
        if (!numericValue($skip) || !numericValue($number)) return false;
        //查询数据库
        $allArticle = self::skip($skip)->take($number)->orderBy('add_time', 'desc')->where('status',0)->get();
        if($allArticle){
            return $allArticle;
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
     * 获取最新文章列表
     * @param $num
     * @return bool
     */
    public static function getNewList($num){
        //接收验证参数
        if (!numericValue($num)) return false;
        //查询数据库
        $ArticleList = self::orderBy('add_time', 'desc')->skip(0)->take($num)->where('status',0)->get();
        if($ArticleList){
            return $ArticleList;
        }else{
            return false;
        }
    }

    /**
     * 获取指定id文章内容
     * @param $art_id
     * @return bool
     */
    public static function getArticle($id){
        //接收验证参数
        if (empty($id)) return false;
        //查询数据库
        $article = self::where('id' , $id)->first();
        if($article){
            return $article;
        }else{
            return false;
        }
    }

    /**
     * 修改文章
     * @param $art_id
     * @param $param
     * @return bool
     */
    public static function updateArticle($id,$param)
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
     * 删除文章
     * @param $art_id
     * @return bool
     */
    public static function deleteArticle($id)
    {
        //接收验证参数
        if ( empty($id) ) return false;
        $res = self::where('id', $id)->update(['status' =>1]);
        if ($res) {
            return true;
        } else {
            return false;
        }

    }

}
