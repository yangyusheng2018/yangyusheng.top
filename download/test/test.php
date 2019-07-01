<?php
//function getdomain($extend){
//    $redismodel=new redis();
//    $redismodel->connect("127.0.0.1","6379");
//    $redismodel->auth("yangyusheng1234");
//    $domains=$redismodel->lrange( $extend."_domains", 0, -1 );
//    var_dump($domains);
//    $redismodel->close();
//    $domains = array_unique($domains);
//    return $domains;
//}
//$domains=getdomain("nl");
//var_dump($domains);
$redismodel=new Redis();
$redismodel->connect("127.0.0.1","6379");
$redismodel->auth("yangyusheng1234");
echo $redismodel->lindex('vpsip',1);
$redismodel->close();


