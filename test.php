<?php
ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
set_time_limit(60);// 通过set_time_limit(0)可以让程序无限制的执
do{
	sleep(1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://".$_SERVER['SERVER_NAME']."/check/test");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false) ; // 获取数据返回
$data = curl_exec($ch);
curl_close($ch);
}while(1);