<?php
sleep(58);

$redis=new Redis();
$redis->connect("127.0.0.1",6379);
$redis->auth("yangyusheng1234");
$alldomains=$redis->lrange( "ch_domains", 0, -1 );
$time1=time();
if($alldomains!=[]){
    do {
        foreach ($alldomains as $s) {
            $nPID = pcntl_fork();
            if ($nPID == 0) {
                $domainarr=explode("----",$s);

             echo file_get_contents("https://api.internet.bs/Domain/Create?ApiKey=" . $domainarr[1] . "&Password=" . $domainarr[2] . "&Domain=" . $domainarr[0] . "&CloneContactsFromDomain=" . $domainarr[3]);
                unset($s);
                exit(0);
            }
        }
        sleep(1);
        $time2=time();
        $tim3=$time2-$time1;
    }while($tim3<10);
}else{
    echo "没有域名";
}

$redis->delete("ch_domains");
$redis->close();