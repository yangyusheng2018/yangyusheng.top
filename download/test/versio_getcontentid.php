<?php
$userpwd=$_GET["userpwd"];
$ch=curl_init();
$url = "https://www.versio.nl/api/v1/contacts";
curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
echo $output = curl_exec($ch);
//    echo $output;
curl_close($ch);
