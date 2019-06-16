<?php
$token="Yzc4ZWRhN2MyZjI4NWJmYmFlMGYxZDFhNmVjNjZlYmU4ZjhhYzQxZDEyMWY3NjMxOTRkYTBjNmMxNzI4ODI3ZA";
$domain="cusheryangyusheng1.nl";
$extent_id=4;
$curl = curl_init();
//设置抓取的url
curl_setopt($curl, CURLOPT_TIMEOUT, 5);
$header=[
    "Accept:application/json",
    "Authorization: Bearer ".$token,
    "Content-Type: application/x-www-form-urlencoded"
];
curl_setopt($curl, CURLOPT_URL, 'https://api.neostrada.com/api/orders/add/');
//设置头文件的信息作为数据流输出
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
$ipdata=file("http://www.yangyusheng.top/download/ips.txt");
if(trim($ipdata[0])==""){
    file_get_contents("http://yangyusheng.top/download/createiptxt.php");
}
$post_data =[
    'extension_id'=>$extent_id,
    'domain'=> $domain,
    'year'=>"1",
    "holder_id"=>1234,
    "external_ip"=>trim($ipdata[0]),
];

curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:20.0) Gecko/20100101 Firefox/20.0');
var_dump($ipdata);
//    var_dump($ipdata);
//var_dump($ipdata);
curl_setopt($curl, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
curl_setopt($curl, CURLOPT_PROXY, trim($ipdata[0])); //代理服务器地址
curl_setopt($curl, CURLOPT_PROXYPORT, trim($ipdata[1])); //代理服务器端口


curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式

curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));

//设置获取的信息以文件流的形式返回，而不是直接输出。
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
////执行命令
$data = curl_exec($curl);
//关闭URL请求
var_dump($data);
curl_close($curl);
var_dump(json_decode($data,true));