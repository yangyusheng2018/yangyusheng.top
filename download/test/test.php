<?php
$ch=curl_init();
$url = "https://www.versio.nl/api/v1/domains/eps-betontechniek.nl";
echo $url."<br>";
$post_data =[
    'years'=>1,
    "contact_id"=>489205,
];
$data_string = json_encode($post_data);
$header=[
    "Accept:application/json",
    'Content-Length: '. strlen($data_string)
];
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_USERPWD, "1611337277@qq.com:qwer1234");
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
echo $output = curl_exec($ch);
//    echo $output;
curl_close($ch);
var_dump(json_decode($output,true));
//$url="https://www.versio.nl/api/v1/domains/:domain/availability";
//echo file_get_contents($url);
