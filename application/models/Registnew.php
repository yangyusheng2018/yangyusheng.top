<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author pc-201707241653\administrator
 */
class RegistnewModel {

    public $errno=0;
    public $errmsg="123";
    public function __construct() {

        $db_ms='mysql';  //数据库类型
        $db_host='localhost';  //主机地址
        $db_user='root';  //数据库账号
        $redismodel=new Redis();
        $redismodel->connect("127.0.0.1","6379");
        $redismodel->auth("yangyusheng1234");
        $datapws= $redismodel->get('mysqlpwd');
        $redismodel->close();
        $db_pass=$datapws;  //数据库密码
        $db_name='user'; //数据库名
        $dbh=$db_ms.':host='.$db_host.';'.'dbname='.$db_name;
        $this->pdo=new PDO($dbh,$db_user,$db_pass);
        $this->pdo->query('set names utf8');
    }
    public function nlapi1regist($domain,$apikey,$password,$holderid){
        $API = new NeostradaModel();
        $domainarr=explode(".",$domain);
        $API->SetAPIKey($apikey);
        $API->SetAPISecret($password);
        $API->prepare('register', array(
            'domain'	=>$domainarr[0],
            'extension'	=> $domainarr[1],
            'holderid'	=> $holderid,
            'period'	=> '1',
            'webip'		=> '',
            'packageid'	=> ''
        ));
        $API->execute();
        $results = $API->fetch();
        return $results;
    }
    public function nlapi2regist($domain,$token,$extent_id){
        $curl = curl_init();
//设置抓取的url
        $header=[
            "Accept:application/json",
            "Authorization: Bearer ".$token,
            "Content-Type: application/x-www-form-urlencoded"
        ];
        curl_setopt($curl, CURLOPT_URL, 'https://api.neostrada.com/api/orders/add/');
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        $post_data =[
            'extension_id'=>$extent_id,
            'domain'=>$domain,
            'year'=>"1"
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));

//设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

////执行命令
        $data = curl_exec($curl);
//关闭URL请求
        curl_close($curl);
//显示获得的数据
        return json_decode($data,true);
    }
    public function userregist($domain){
        $nowtime=time();
        $query=$this->pdo->prepare("select *  from domains where Domain=?");
        $query->execute([$domain]);
        $ress=$query->fetchAll();
        $users=$ress[array_rand($ress,1)];

        $res2=$this->nlapi1regist($domain,$users["apikey1"],$users["password"],$users["holderid"]);
        var_dump($res2);
        $code2=$res2["code"];
        if($code2==200) {
            $messages="域名购买成功";
            $domainmodel=new DomainsModel();
            $domainmodel->toIsSend($domain);
            $redismodel=new redis();
            $redismodel->connect("127.0.0.1",6379);
            $redismodel->lRemove("domains",$domain,1);
            $redismodel->lRemove("be_domains",$domain,1);
            $redismodel->close();
            $logstr="";
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2shibai.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n".$domain."api1shibai已完成\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
        }else{
            $messages="域名购买失败";
            $logstr="";
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2shibai.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n".$domain."api1shibai购买失败\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();


            $res1=$this->nlapi2regist($domain,$users["apikey"],$users["extent_id"]);
            $code=$res1["code"];
            if($code==200) {
                $messages="域名购买成功";
                $domainmodel=new DomainsModel();
                $domainmodel->toIsSend($domain);
                $redismodel=new redis();
                $redismodel->connect("127.0.0.1",6379);
                $redismodel->lRemove("domains",$domain,1);
                $redismodel->lRemove("be_domains",$domain,1);
                $redismodel->close();
                $logstr="";
                $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2chenggong.txt';
                $nowdate=date("Y-m-d H:i:s",time());
                $logstr=$nowdate."\n".$domain."api2chenggong已完成\n";
                file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                ob_flush();flush();
            }elseif($code==400){
                $messages="域名购买失败";
                $logstr="";
                $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2shibai.txt';
                $nowdate=date("Y-m-d H:i:s",time());
                $logstr=$nowdate."\n".$domain."api2shibai购买失败\n";
                file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                ob_flush();flush();
            }
        }




    }
    public function getnl(){
        $res="";
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1",6379);
        $redismodel->auth("yangyusheng1234");
        $domains_nl=$redismodel->lRange("domains",0,-1);
        $redismodel->close();
        return $domains_nl;
    }
    public function getbe(){
        $res="";
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1",6379);
        $redismodel->auth("yangyusheng1234");
        $domains_be=$redismodel->lRange("be_domains",0,-1);
        $redismodel->close();
        return $domains_be;
    }
    public function registnl(){
        $domains_nl=$this->getnl();
        foreach ($domains_nl as $domain){
            sleep(1);
            $apicheckmodel=new ApischeckModel();
            $checkid=mt_rand(0,0);
            switch ($checkid){
                case 0;
                    $res=$apicheckmodel->sidndns($domain);
                    echo "sidndns<br>";
                    break;
                case 1;
                    $res=$apicheckmodel->sidn($domain);
                    echo "sidn<br>";
                break;
                case 2;
                    $res=$apicheckmodel->creazy($domain);
                    echo "creazy<br>";
                 break;
                case 3;
                    $res=$apicheckmodel->sidndns($domain);
                    echo "bigrock<br>";
                    break;
                case 4;
                    $res=$apicheckmodel->combaba($domain);
                    echo "combaba<br>";
                    break;
                case 5;
                    $res=$apicheckmodel->myorderbox1($domain);
                    echo "myorderbox1<br>";
                    break;
                case 6;
                    $res=$apicheckmodel->myorderbox2($domain);
                    echo "myorderbox2<br>";
                    break;
                case 7;
                    $res=$apicheckmodel->hostgator($domain);
                    echo "hostgator<br>";
                    break;
            }
            if($res==1){
                $this->userregist($domain);
            }elseif($res==-1){
                echo "已被注册";
                $domainmodel=new DomainsModel();
                $domainmodel->toIsSend2($domain);
            }
        }
    }
    public function registbe(){
        $domains_be=$this->getbe();
        foreach ($domains_be as $domain){
            sleep(1);
            $apicheckmodel=new ApischeckModel();
            $checkid=mt_rand(3,3);
            switch ($checkid){
                case 1;
                    echo "lgium<br>";
                    $res=$apicheckmodel->lgium($domain);
                    break;
                case 2;
                    echo "creazy<br>";
                    $res=$apicheckmodel->creazy($domain);
                    break;
                case 3;
                    echo "dnsbe<br>";
                    $res=$apicheckmodel->dnsbe($domain);
                    sleep(0.1);
                    break;

            }
            if($res==1){
                $this->userregist($domain);
            }elseif ($res==-1){
                $domainmodel=new DomainsModel();
                $domainmodel->toIsSend2($domain);
            }
        }

    }






}