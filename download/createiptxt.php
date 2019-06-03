<?php
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL, '"http://webapi.http.zhimacangku.com/getip?num=1&type=2&pro=310000&city=310112&yys=0&port=11&time=2&ts=0&ys=0&cs=0&lb=1&sb=0&pb=4&mr=1&regions="');
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_POST, 0);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//$jsondata = curl_exec($curl);
//        curl_close($curl);

//
$jsondata=file_get_contents("http://webapi.http.zhimacangku.com/getip?num=1&type=2&pro=310000&city=310112&yys=0&port=11&time=2&ts=0&ys=0&cs=0&lb=1&sb=0&pb=4&mr=1&regions=");
var_dump($jsondata);
$data=json_decode($jsondata,JSON_UNESCAPED_UNICODE);
//return ["ip"=>$data["data"][0]["ip"],"port"=> $data["data"][0]["port"]] ;
$iptxt=fopen("ips.txt","w+");
if($data["data"][0]["ip"]!=""&$data["data"][0]["port"]!=""){
    fwrite($iptxt,$data["data"][0]["ip"]."\n".$data["data"][0]["port"]."\n");
    fclose($iptxt);
}else{
    fclose($iptxt);
}
