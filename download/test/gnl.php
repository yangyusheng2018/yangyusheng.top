<?php
$time1=time();

do{
    require_once ("check.php");
    $registmodel=new RegistnewModel();
    $registmodel->registgnl();
    usleep(500000);
    $time2=time();
    $tim3=$time2-$time1;
}while($tim3<58);

