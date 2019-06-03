<?php
//e6d0d897fee36805be75cde79b561398
//u@A$a$eq
//OTQ4ODk5OTJkNWQxYTgwMmUwY2RiOWY0ODhhMWMxNTI2MzhmYjhiOTg5NGU4ZGVlNTJjNjFlNzMxOGU2OTE5NA


class Goregist{
    public function regist($domainss){
        $key=[
            'e6d0d897fee36805be75cde79b561398:u@A$a$eq',
            'c19b4d98895357239f0b0bd1918d3ce6:ugE#Adej',
            '296639ca8f6346d63ad8a164aff7cbfe:#E%ehy@e',
            '1ee82b564a7ffcf4f02eb471d38b3701:dEpysase',
            'e11122ec80d4247a61db4db618503ef8:adY@azA#',
            '032b9eb822a253f9b2deb7d301b64bfa:zYmAmutE',
            '64b61a769e8d4c3c957adb759b393bdc:UjU%adej',
            '6645214cb8c2a0ff27a3faf6016a1af2:myjasArE',
            'eb2481c741fe725564f8a7f87bfbb52a:a#UjAvuq',
            '64843e6943ecb83771f4ac83746de295:y%UrYbuz',
            'd1f0aec424b1de8682e70fb90eaea05b:2tsqhdMvOA94',
            '66daf6932a5a8c9f0fd36ca8d99b4a6c:gHAdCmN4ajlB',
            '2fcc7dbb6d969fe869bd58b023897c63:fROq216sXOly',
            '17ea6bf47bb43bc521b61b62eca4eff5:GoBmqNzLKpIT',
            'fbb4d3125420b6b53e3990680e7315a6:eZ9XiyvkTzxS',
            'a8a98b23fc86b00e476555bd009adf6b:s8ylhpNT2UhL',
            '92ef122d47f3346537cd4483415f4780:5DVQePkFR9y5',
            '503b1200ffcbe4a8a49bcd338bb30eda:HxIAHzHA9THR',
            '94d779b1ccd9444a9fcde4186548e931:EtF06wTRrdbP',
            'ef428178263608a30450a261d64fc299:wnACZX8DQ6v6',
        ];
        $randkey=array_rand($key,1);
        $randapikey=$key[$randkey];
        echo $randapikey."<br>";
        require_once ("model.php");
        $domain=explode(".",$domainss);
        $API = Neostrada::GetInstance();
        $randapikey=explode(":",$randapikey);
        $API->SetAPIKey($randapikey[0]);
        $API->SetAPISecret($randapikey[1]);
        $API->prepare('whois', array(
            'domain'	=> $domain[0],
            'extension'	=> $domain[1],
        ));
        $API->execute();
        $results = $API->fetch();

        if($results['code'] != 210){
            $res="域名不可用";
            $logstr="";
            $payLogFile = 'logtxt1.txt';
            $nowdate=date("Y-m-d H:i:s",time()+3600*7);
            $logstr=$nowdate."\n".$domainss."不可用\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
//            ob_flush();flush();
        }else{

            $res="域名可注册";
            $logstr="";
            $payLogFile = 'logtxt1.txt';
            $nowdate=date("Y-m-d H:i:s",time()+3600*7);
            $logstr=$nowdate."\n".$domainss."可用\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
//            ob_flush();flush();
//            $domain=explode(".",$domainss);
//            $API1 = Neostrada::GetInstance();
//            $API1->SetAPIKey('1a3a08bd5d175021ec5ea926b4580900');
//            $API1->SetAPISecret('ja$upA@a');
//
//            $holderids=[
//                "16123","16124","16125","16126",
//            ];
//            $holderid=$holderids[array_rand($holderids,1)];
//
//            $API1->prepare('register', array(
//                'domain'	=> $domain[0],
//                'extension'	=> $domain[1],
//                'holderid'	=> $holderid,
//                'period'	=> 1,
//                'webip'		=> '', // leave this empty to use the Neostrada's default IP address
//                'packageid'	=> '' // optional package ID to add a Neostrada hosting package, contact us for the correct IDs
//            ));
//            $API1->execute();
//            $res=$API1->fetch();
//            if($res["code"]==200) {
//                $logstr="";
//                $payLogFile = 'logtxt1.txt';
//                $nowdate=date("Y-m-d H:i:s",time()+3600*7);
//                $logstr=$nowdate."\n".$domainss."已完成\n";
//                file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
//                ob_flush();flush();
//            }
        }
        return $res;
    }
}
ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
set_time_limit(10);// 通过set_time_limit(0)可以让程序无限制的执
do{
$domains=[
    "1234.nl",
    "1235.nl",
    "1236.nl",
    "1237.nl",
    "wr234t34ty45yh56u57u.nl",
];
foreach ($domains as $domain){
    $goregist=new Goregist();
    var_dump($goregist->regist($domain));
}
    sleep(1);

}while(1);



