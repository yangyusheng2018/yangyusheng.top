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
        $config=file("/home/api/config.txt");
        $this->datapws=trim($config[2]);
        $this->token=trim($config[1]);

        $db_ms='mysql';  //数据库类型
        $db_host='104.248.147.202';  //主机地址
        $db_user='root';  //数据库账号
        $db_pass=$this->datapws;  //数据库密码
        $db_name='user'; //数据库名
        $dbh=$db_ms.':host='.$db_host.';'.'dbname='.$db_name;
        $this->pdo=new PDO($dbh,$db_user,$db_pass);
        $this->pdo->query('set names utf8');
    }

    public function nlapi2check($domains){
        $curl = curl_init();
//设置抓取的url
        $header=[
            "Accept:application/json",
            "Authorization: Bearer ".$this->token,
            "Content-Type: application/x-www-form-urlencoded"
        ];
        curl_setopt($curl, CURLOPT_URL, 'https://api.neostrada.com/api/bulkwhois');
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        $post_data =[
            "domain" => $domains,
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

    public function nlapi2regist($domain,$token,$extent_id){
        $domain_ext=$domain["domain"].".".$domain["extension"];
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
            'domain'=>$domain_ext,
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


    public function getavailabledomains($result){
        if ($result["error"]=="invalid_grant"){
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2errlog.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n"."apitoken错误"."\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
        }else{
            $availabledomains=[];
            foreach ($result["results"] as $res){
                if ($res["available"]==true){
                    $availabledomains[]=["domain"=>$res["domain"],"extension"=>$res["extension"]];
                }
            }
            return $availabledomains;
        }

    }
    public function api2regist($availabledomains){
        if($availabledomains==[]){
            echo "没有可注册域名";
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n"."没有可注册域名"."\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
        }else{
            foreach ($availabledomains as $domain){
                var_dump($domain);
                $domain_ext=$domain["domain"].".".$domain["extension"];
                var_dump($domain_ext);
                $nowtime=time();
                $query=$this->pdo->prepare("select *  from domains where start_time<? and end_time>? and is_send=0 AND Domain=?");
                $query->execute([$nowtime,$nowtime,$domain_ext]);
                $ress=$query->fetchAll();
                var_dump($ress);
                $users=$ress[array_rand($ress,1)];

                $res1=$this->nlapi2regist($domain,$users["apikey"],$users["extent_id"]);

                var_dump($res1);
                $code=$res1["code"];
                if($code==200) {
                    $messages="域名购买成功";
                    $query=$this->pdo->prepare("update domains set is_send=3 where Domain=?");
                    $query->execute([$domain_ext]);
                    $logstr="";
                    $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2chenggong.txt';
                    $nowdate=date("Y-m-d H:i:s",time());
                    $logstr=$nowdate."\n".$domain_ext."已完成\n";
                    file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                    ob_flush();flush();
                }elseif($code==400){
                    $messages="域名购买失败";
                    $logstr="";
                    $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2shibai.txt';
                    $nowdate=date("Y-m-d H:i:s",time());
                    $logstr=$nowdate."\n".$domain_ext."购买失败\n";
                    file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                    ob_flush();flush();
                }
            }
        }


    }
    public function api2goregist(){
        $domains=file("domains.txt");
        var_dump($domains);
        if($domains==[]){
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/be_domains_api2.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n"."没有域名可用\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
            $res="没有域名可用\n";
        }else{
            $result=$this->nlapi2check($domains);
            $availabledomains=$this->getavailabledomains($result);
            $this->api2regist($availabledomains);
        }

        return $res;
    }

}
