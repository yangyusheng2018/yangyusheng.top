<?php
$time1=time();

do{
    echo "y";
    require_once ("check.php");
    $registmodel=new RegistnewModel();
    $registmodel->dd24nl();
//    usleep(100000);
    $time2=time();
    $tim3=$time2-$time1;
}while($tim3<59);
