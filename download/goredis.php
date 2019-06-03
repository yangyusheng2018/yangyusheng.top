<?php
    $config=file("/home/api/config.txt");
    $datapws=trim($config[2]);
    $db_ms='mysql';  //数据库类型
    $db_host='104.248.147.202';  //主机地址
    $db_user='root';  //数据库账号
    $db_pass=$datapws;  //数据库密码
    $db_name='user'; //数据库名
    $dbh=$db_ms.':host='.$db_host.';'.'dbname='.$db_name;
    $pdo=new PDO($dbh,$db_user,$db_pass);
    $pdo->query('set names utf8');
    $nowtime=time();
    $query=$pdo->prepare("select Domain from domains where start_time<? and end_time>? and is_send=0");
    $query->execute([$nowtime,$nowtime]);
    var_dump($ress=$query->fetchAll());
    $file=fopen("domains.txt","w");
    foreach ($ress as $res){
            fwrite($file,$res["Domain"]."\n");
    }
    fclose($file);

