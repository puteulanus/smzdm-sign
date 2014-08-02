<?php
header("Content-type:text/html;charset=utf-8");
// 设定用户名密码
$username = '';// 邮箱
$password = '';// 密码
// 模拟登陆获取cookie
$time = time().rand(100,999);
$url = 'http://www.smzdm.com/user/login/jsonp_check?user_login='.$username.'&user_pass='.$password.'&rememberme=0&is_third=&is_pop=1&captcha=&_='.$time;
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_HEADER,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 
$content = curl_exec($ch);
preg_match_all('/Set-Cookie:(.*;)/iU',$content,$str); 
curl_close($ch); 
foreach ($str[1] as $key) {
    if (strpos($key,'deleted') == false){
        $cookie .= $key;
    }
}
// 使用cookie签到
$time = time().rand(100,999);
$time2 = $time + 3;
$url = 'http://www.smzdm.com/user/qiandao/jsonp_checkin?callback=jQuery'.'11100'.rand(1000,9999).rand(1000,9999).rand(1000,9999).rand(1000,9999).'_'.$time.'&_='.$time2;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); 
curl_setopt($curl, CURLOPT_COOKIE, $cookie);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_HEADER, 0); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$str = curl_exec($curl);
if (curl_errno($curl)) {
    echo 'Errno'.curl_error($curl);
}
curl_close($curl);
echo $str;
