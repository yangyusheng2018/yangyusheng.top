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

    public function nlapi2check($domains){
        $curl = curl_init();
//设置抓取的url
        $header=[
            "Accept:application/json",
            "Authorization: Bearer YjU5M2RlZDZmYTllMjgwNWJhODBmYzU5NzgzMDg4MDUxMTA2ZmYwZWZlNjYzZjExOGJiY2I0OTNjZmEzODViOQ",
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

    public function nlapi2whois($domains){
        foreach ($domains as $domain){
            $curl = curl_init();
            $keyarray=[
                "MDk5YTNlOGI3YzBmNjc5Yjk0MWE2MzU0ODg0MWY4NDA0NjdmNjAxOTE1YmM1OGY0MzkzOWI3YWVhYjZkMzFkNA",
                "ODJmOWI5NDk1ZjkxNTY5YTU3YTBkMWRhYTRjMGYxMjZlYmZiZmQ0YTE5YWJjZjA1ZTM2MmI2ZjA1MzdjMjhmYw",
                "Yzc4ZWRhN2MyZjI4NWJmYmFlMGYxZDFhNmVjNjZlYmU4ZjhhYzQxZDEyMWY3NjMxOTRkYTBjNmMxNzI4ODI3ZA",
                "YjU5M2RlZDZmYTllMjgwNWJhODBmYzU5NzgzMDg4MDUxMTA2ZmYwZWZlNjYzZjExOGJiY2I0OTNjZmEzODViOQ",
                "OTczMWJmMDgxMzNkMzdmOTZkN2YyYWJhMzcxZWY5OGE4MjM5OTQ1NWVmMDQ1ZTdlYzVhNjFiZDgxYzJhMDUxNg",

            ];
            $keyss=$keyarray[array_rand($keyarray,1)];

//设置抓取的url
//curl -i -H "Accept:application/json" -H "Authorization: Bearer YjU5M2RlZDZmYTllMjgwNWJhODBmYzU5NzgzMDg4MDUxMTA2ZmYwZWZlNjYzZjExOGJiY2I0OTNjZmEzODViOQ" --data "domain=123.nl" https://api.neostrada.com/api/whois
            $header=[
                "Accept:application/json",
                "Authorization: Bearer ".$keyss,
                "Content-Type: application/x-www-form-urlencoded"
            ];
            curl_setopt($curl, CURLOPT_URL, 'https://api.neostrada.com/api/whois');
//设置头文件的信息作为数据流输出
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 1);
            $post_data =[
                "domain" => $domain,
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
            $data=json_decode($data,true);
            var_dump($data);
            echo "<br>";
            if($data["results"][0]["available"]==true){
                $domainarray=["domain"=>$data["results"][0]["domain"],"extension"=>$data["results"][0]["extension"]];
                     var_dump($domain);
                     echo "<br>";
                var_dump($domainarray);
                $nowtime=time();
                $query=$this->pdo->prepare("select *  from domains where start_time<? and end_time>? and is_send=0 AND Domain=?");
                $query->execute([$nowtime,$nowtime,$domain]);
                $ress=$query->fetchAll();
                var_dump($ress);
                $users=$ress[array_rand($ress,1)];

//$users["apikey"]='N2JlODI2OTdkZGJhYjEwZTYxNmI0N2YzOTlhNGRhMTM2MTNkYTUwZDM5ZTZkNGEyZDMyYWYwMDQ5ODMzMDdhYg';
//                $domainarray["domain"]="fwefwegwergwgergerger";
//                $domainarray["extension"]="nl";
//                $users["extent_id"]=4;

                $res1=$this->nlapi2regist($domainarray,$users["apikey"],$users["extent_id"]);
                $code=$res1["code"];
                if($code==200) {
                    $messages="域名购买成功";
                    $domainmodel=new DomainsModel();
                    $domainmodel->toIsSend($domain);
                    $redismodel=new redis();
                    $redismodel->connect("127.0.0.1",6379);
                    $domains=$redismodel->lRemove("domains",$domain,1);
                    $redismodel->close();
                    $logstr="";
                    $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2chenggong.txt';
                    $nowdate=date("Y-m-d H:i:s",time());
                    $logstr=$nowdate."\n".$domain."已完成\n";
                    file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                    ob_flush();flush();
                }elseif($code==400){
                    $messages="域名购买失败";
                    $logstr="";
                    $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2shibai.txt';
                    $nowdate=date("Y-m-d H:i:s",time());
                    $logstr=$nowdate."\n".$domain."购买失败\n";
                    file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
                    ob_flush();flush();
                }
            }
//显示获得的数据
        }
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
                    $domainmodel=new DomainsModel();
                    $domainmodel->toIsSend($domain_ext);
                    $redismodel=new redis();
                    $redismodel->connect("127.0.0.1",6379);
                    $domains=$redismodel->lRemove("domains",$domain_ext,1);
                    $redismodel->close();
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
        $res="";
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1",6379);
        $redismodel->auth("yangyusheng1234");
        $domains_be=$redismodel->lRange("be_domains",0,-1);
        $domains_nl=$redismodel->lRange("domains",0,-1);
        $domains=array_merge($domains_be,$domains_nl);
        $redismodel->close();
        var_dump($domains);
        if($domains==[]){
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/be_domains_api2.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n"."没有域名可用\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
            $res="没有域名可用\n";
        }else{
            $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/api2.txt';
            $nowdate=date("Y-m-d H:i:s",time());
            $logstr=$nowdate."\n"."检测域名\n";
            file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
            ob_flush();flush();
            $res="检测域名\n";
            $this->nlapi2whois($domains);
        }

        return $res;
    }
    public function ceshi(){
        var_dump(123);
        echo "123";
    }
}
