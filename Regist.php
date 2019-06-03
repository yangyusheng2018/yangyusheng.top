<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author pc-201707241653\administrator
 */
class RegistModel {
    public $errno=0;
    public $errmsg="123";
    public function __construct() {

        $db_ms='mysql';  //数据库类型
        $db_host='104.248.147.202';  //主机地址
        $db_user='root';  //数据库账号
        $db_pass='123456';  //数据库密码
        $db_name='user'; //数据库名
        $dbh=$db_ms.':host='.$db_host.';'.'dbname='.$db_name;
        $this->pdo=new PDO($dbh,$db_user,$db_pass);
        $this->pdo->query('set names utf8');
    }

    public function regist($domainss){
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1",6379);
        $redismodel->auth("123456");
        $key=$redismodel->lRange("godaddykeys",0,-1);
        $redismodel->close();
        $randkey=array_rand($key,1);
        $randapikey=$key[$randkey];
        $ch = curl_init();
        $url = "https://api.godaddy.com/v1/domains/available?domain=".$domainss."&checkType=FAST&forTransfer=false";
        $header=[
            'accept: application/json',
            'Authorization: sso-key '.$randapikey
        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);

        $check=json_decode($output,true);
        if($check["available"]==true){
            $domain=explode(".",$domainss);
            $API=NeostradaModel::GetInstance();
            $nowtime=time()+3600*7;
            $query=$this->pdo->prepare("select *  from domains where start_time<? and end_time>? and is_send=0 AND Domain=?");
            $query->execute([$nowtime,$nowtime,$domainss]);
            $ress=$query->fetchAll();
            $res=$ress[array_rand($ress,1)];

            $API->SetAPIKey($res["ApiKey"]);
            $API->SetAPISecret($res['Password']);
            $API->prepare('register', array(
                'domain'	=> $domain[0],
                'extension'	=> $domain[1],
                'holderid'	=> $res['holderid'],
                'period'	=> 1,
                'webip'		=> '', // leave this empty to use the Neostrada's default IP address
                'packageid'	=> '' // optional package ID to add a Neostrada hosting package, contact us for the correct IDs
            ));
            $API->execute();
            $res=$API->fetch();
            $res=$res["code"];

            if($res==200) {
                $domainmodel=new DomainsModel();
                $domainmodel->toIsSend($domainss);
                $redismodel=new redis();
                $redismodel->connect("127.0.0.1",6379);
                $redismodel->auth("123456");
                $domains=$redismodel->lRemove("domains",$domainss,1);
                $redismodel->close();
                $logstr="";
                $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/logtxt.txt';
                $nowdate=date("Y-m-d H:i:s",time()+3600*7);
                $logstr=$nowdate."\n".$domainss."已完成\n";
                file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                ob_flush();flush();
            }
        }else{
            $res="域名不可用";
            $logstr="";
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/logtxt.txt';
            $nowdate=date("Y-m-d H:i:s",time()+3600*7);
            $logstr=$nowdate."\n".$domainss."不可用\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
        }
        return $res;
    }
    public function regist1($domainss){
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1",6379);
        $redismodel->auth("123456");
        $key=$redismodel->lRange("nlapikeys",0,-1);
        $redismodel->close();
        $randkey=array_rand($key,1);
        $randapikey=$key[$randkey];
        $API=NeostradaModel::GetInstance();
        $domain=explode(".",$domainss);
        $randapikey=explode(":",$randapikey);
        $API->SetAPIKey($randapikey[0]);
        $API->SetAPISecret($randapikey[1]);
        $API->prepare('whois', array(
            'domain'	=> $domain[0],
            'extension'	=> $domain[1],
        ));
        $API->execute();
        $results = $API->fetch();


        if($results["code"]==210){
            $domain=explode(".",$domainss);
            $API=NeostradaModel::GetInstance();
            $nowtime=time();
            $query=$this->pdo->prepare("select *  from domains where start_time<? and end_time>? and is_send=0 AND Domain=?");
            $query->execute([$nowtime,$nowtime,$domainss]);
            $ress=$query->fetchAll();
            $res=$ress[array_rand($ress,1)];


            $API->SetAPIKey($res["ApiKey"]);
            $API->SetAPISecret($res['Password']);
            $API->prepare('register', array(
                'domain'	=> $domain[0],
                'extension'	=> $domain[1],
                'holderid'	=> $res['holderid'],
                'period'	=> 1,
                'webip'		=> '', // leave this empty to use the Neostrada's default IP address
                'packageid'	=> '' // optional package ID to add a Neostrada hosting package, contact us for the correct IDs
            ));
            $API->execute();
            $res=$API->fetch();
            $res=$res["code"];
            if($res==200) {
                $domainmodel=new DomainsModel();
                $domainmodel->toIsSend($domainss);
                $redismodel=new redis();
                $redismodel->connect("127.0.0.1",6379);
                $domains=$redismodel->lRemove("domains",$domainss,1);
                $redismodel->close();
                $logstr="";
                $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/logtxt.txt';
                $nowdate=date("Y-m-d H:i:s",time());
                $logstr=$nowdate."\n".$domainss."已完成\n";
                file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                ob_flush();flush();
            }
        }else{
            $res="域名不可用";
            $logstr="";
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/logtxt.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n".$domainss."不可用\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
        }
        return $res;
    }
    public function toregist(){
        $res="";
      $redismodel=new redis();
      $redismodel->connect("127.0.0.1",6379);
        $redismodel->auth("123456");
      $domains=$redismodel->lRange("domains",0,-1);
      $redismodel->close();
      foreach ($domains as $domain){
          $res.=$this->regist1($domain);
      }
      return $res;
   }
}
