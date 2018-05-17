<?php
namespace wxappSdk;

/**
 * @author 小林囝 <dong@linyudong.cn>
 */
class wxappSdk
{
    protected $appid;
    protected $appsecret;
    protected $jscode2sessionUrl = 'https://api.weixin.qq.com/sns/jscode2session?';

	public function __construct($appid = '', $appsecret = '')
    {
        $this->appid = $appid;
        $this->appsecret = $appsecret;
    }

    /**
     * 临时登录凭证code 获取 session_key 和 openid 等。
     * @param $code string
     * @return array
	 * @help https://developers.weixin.qq.com/miniprogram/dev/api/api-login.html
     */
    public function login($code)
    {
		if($code){return ['errcode'=>1000,'errmsg'=>'code不能为空'];}
        $url = $jscode2sessionUrl.'appid='.$this->appid.'&secret='.$this->appsecret.'&js_code='.$code.'&grant_type=authorization_code';
		$ch = curl_init();
        $timeout = 600;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $str = curl_exec($ch);
        curl_close($ch);
        if(false == $str){return ['errcode'=>1001,'errmsg'=>'获取登录信息失败，请重新打开试试'];}
        return json_decode($str,true);
    }

    protected function test($txt)
    {
		return $txt;
    }
}