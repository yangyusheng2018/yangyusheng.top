<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/23
 * Time: 10:42
 */
//echo $_SERVER['DOCUMENT_ROOT'];
//$config=file("/home/api/config.txt");
//var_dump($config);

//$file_contents = file_get_contents('https://www.baidu.com/');
//var_dump($file_contents);
//


echo $CloneContactsFromDomain="4x4moc.ch";
$itparameter="&registrant_clientip=104.248.147.202&registrant_dotitterm1=yes&registrant_dotitterm2=yes&registrant_dotitterm3=yes&registrant_dotitterm4=yes";
$out=file_get_contents("https://api.internet.bs/Domain/Create?ApiKey=D1I8R8Z9M2B4C6J1K4Y3&Password=qwer1234&Domain=123.ch&CloneContactsFromDomain=".$CloneContactsFromDomain);
var_dump($out);

