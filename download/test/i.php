<?php

$res[$domain]=0;
$ips = file("http://yangyusheng.top/download/vpsip.txt");
$ip = $ips[mt_rand(1, count($ips))-1];
$res[$domain] = file_get_contents("http://" . trim($ip) . "/checkaction.php?domain=" . $domain);