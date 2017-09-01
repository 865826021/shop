<?php
namespace App\Tools;

class Common
{

    /**
     * CURLf方法
     * @param $url 请求的URL
     * @param bool $params 参数
     * @param int $ispost post或者get
     * @param int $https
     * @return bool
     */
    public static function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {

            if ($params) {
                if (is_array($params)){
                    $params =  http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);


        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }

    /**
     * 判断是否是邮箱
     * @param $email
     * @return bool
     */
    public static function isEmail($email)/*{{{*/
    {
        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否是手机号码
     * @param $mobile
     * @return mixed
     */
    public static function isMobile($mobile)
    {
        $preg_mobile = '/^(130|131|132|133|134|135|136|137|138|139|150|151|152|153|154|155|156|157|158|159|170|171|177|180|181|182|183|184|185|186|187|188|189)\d{8}$/';
        return preg_match($preg_mobile, $mobile);
    }

    /**
     * 数组转对象
     * @param $e
     * @return object|void
     */
    public function arrayToObject($e)
    {

        if (gettype($e) != 'array') return;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object')
                $e[$k] = (object)$this->arrayToObject($v);
        }
        return (object)$e;
    }

    /**
     * 对象转数组
     * @param $e
     * @return array|void
     */
    public function objectToArray($e)
    {
        $e = (array)$e;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'resource') return;
            if (gettype($v) == 'object' || gettype($v) == 'array')
                $e[$k] = (array)$this->objectToArray($v);
        }
        return $e;
    }

    //(分类下子分类)递归分层
    public function node_merge($node , $pid = 0){
        $arr = array();
        foreach ($node as $v){
            if($v['pid'] == $pid){
                $v['child'] = (object)$this->node_merge($node , $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    public function node_merge_access($node ,$access = null, $pid = 0){
        $arr = array();
        foreach ($node as $v){
            if(is_array($access)){
                $v['access'] = in_array($v['id'],$access) ? 1 : 0;
            }
            if($v['pid'] == $pid){
                $v['child'] = (object)$this->node_merge_access($node ,$access, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
	    
}
