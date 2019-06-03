<?php
$data=$_POST;
//var_dump($data);
require_once ("model.php");
$API = Neostrada::GetInstance();
$domainarr=explode(".",$data["domain"]);
$API->SetAPIKey($data["apikey"]);
$API->SetAPISecret($data["password"]);
$API->prepare('register', array(
'domain'	=>$domainarr[0],
'extension'	=> $domainarr[1],
'holderid'	=> $data["holderid"],
'period'	=> '1',
'webip'		=> '',
'packageid'	=> ''
));
$API->execute();
$results = $API->fetch();
echo json_encode($results,JSON_UNESCAPED_UNICODE);