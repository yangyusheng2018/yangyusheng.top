<?php
$time1=time();
$arr=[
    "etainsrouxhet.be",
    "fifty-one-turnhout.be",
    "virelac.be",
    "innovationawards.be",
    "janssenpaysage.be",
    "kiddiecard.be",
    "landrada.be",
    "second-life.be",
    "skip-oudenburg.be",
    "trefferke.be",

];
foreach ($arr as $v){
    $nPID = pcntl_fork();
    if ($nPID == 0) {
        echo $v."||";

       if($v=="innovationawards.be"){
           $res=1;
       }else{
           $res=0;
       }
       if($res==1){
           echo "1"."||";
       }
//        echo $res."||";
        sleep(1);
        exit(0);
    }
}
$time2=time();
$time3=$time2-$time1;
echo "运行时长".$time3."||";