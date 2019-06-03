<?php
$time1=time();

do{
    require_once ("check.php");
    $registmodel=new RegistnewModel();
    $registmodel->registgnl();
    sleep(0.5);
    $logstr="";
    $payLogFile = 'logtxt.txt';
    $nowdate=date("Y-m-d H:i:s",time());
    $logstr=$nowdate."\n运行中\n";
    file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
    $time2=time();
    $tim3=$time2-$time1;
}while($tim3<58);
