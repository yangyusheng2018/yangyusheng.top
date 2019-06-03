<?php
$time1=time();
do{
$fen=date("i",time());
    if($fen>43||$fen<40){
    require_once ("check.php");
    $registmodel=new RegistnewModel();
//$registmodel->registnl();
    $registmodel->registgbe();
    sleep(1);
}else{
    sleep(20);
    echo "时间没到<br>";
}
    $time2=time();
    $tim3=$time2-$time1;
}while($tim3<2);
