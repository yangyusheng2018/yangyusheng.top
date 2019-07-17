<?php
class RegistnewModel {
    public $errno=0;
    public $errmsg="123";
    public function __construct() {
    }
    public function getpdo(){
        $redismodel=new Redis();
        $redismodel->connect("127.0.0.1","6379");
        $redismodel->auth("yangyusheng1234");
        $datapws= $redismodel->get('mysqlpwd');
        $redismodel->close();
//        $config=file("config.txt");
//        $datapws=trim($config[2]);
        $db_ms='mysql';  //数据库类型
        $db_host='104.248.147.202';  //主机地址
        $db_user='root';  //数据库账号
        $db_pass=$datapws;  //数据库密码
        $db_name='user'; //数据库名
        $dbh=$db_ms.':host='.$db_host.';'.'dbname='.$db_name;
        $pdo=new PDO($dbh,$db_user,$db_pass);
        return $pdo;
    }
    public function tosendemail($domain){

    }


    public function tosend2($domain){
        echo "加载toIsSend2";
        $pdo = $this->getpdo();
        $pdo->query('set names utf8');
        $query = $pdo->prepare("update domains set is_send = 9 where domain=? AND is_send = 0");
        $res = $query->execute([$domain]);
        $pdo = null;
        var_dump($res);
        echo "已被抢注\n";
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $pdo=null;
    }
    public function nlapi2regist($domain,$token,$extent_id,$holder_id){
        $curl = curl_init();
//设置抓取的url

        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        $header=[
            "Accept:application/json",
            "Authorization: Bearer ".$token,
            "Content-Type: application/x-www-form-urlencoded"
        ];
        curl_setopt($curl, CURLOPT_URL, 'https://api.neostrada.com/api/orders/add/');
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        $ipdata=file("http://www.yangyusheng.top/download/ips.txt");
        if(trim($ipdata[0])==""){
            file_get_contents("http://yangyusheng.top/download/createiptxt.php");
        }
        $post_data =[
            'extension_id'=>$extent_id,
            'domain'=> $domain,
            'year'=>"1",
            "holder_id"=>$holder_id,
            "external_ip"=>trim($ipdata[0]),
        ];
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:20.0) Gecko/20100101 Firefox/20.0');
//    var_dump($ipdata);
//var_dump($ipdata);
        curl_setopt($curl, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
        curl_setopt($curl, CURLOPT_PROXY, trim($ipdata[0])); //代理服务器地址
        curl_setopt($curl, CURLOPT_PROXYPORT, trim($ipdata[1])); //代理服务器端口


        curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式

        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));

//设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
////执行命令
        $data = curl_exec($curl);
//关闭URL请求
        var_dump($data);
        curl_close($curl);
        return json_decode($data,true);
    }
    public function sendchenggong2($domain){
        $pdo=$this->getpdo();
        $query=$pdo->prepare("update domains set is_send = 9 where domain=?");
        $res=$query->execute([$domain]);
        $pdo=null;
        var_dump($res);
        echo "api购买成功";
    }

    public function shibai($domain){
//        $pdo=$this->getpdo();
//        $query=$pdo->prepare("update domains set is_send = is_send +1 where domain=?");
//        $res=$query->execute([$domain]);
//        $pdo=null;
    }
    public function getUserByDomain($domain){
        $nowtime=time();
        $pdo=$this->getpdo();
        $pdo->query('set names utf8');
        $query=$pdo->prepare("select *  from domains where start_time<? and end_time>? and is_send<9 AND Domain=?");
        $query->execute([$nowtime,$nowtime,$domain]);
        $ress=$query->fetchAll();
        $pdo=null;
        return $ress;
    }
    public function neostrada($apikey,$domain,$extent_id,$holderid){
        $ip =  $this->getvpsip();
        $res1= file_get_contents("http://" . trim($ip) . "/registhttp.php?token=".$apikey."&domain=".$domain."&extent_id=".$extent_id."&holder_id=" .$holderid);
        $res1=json_decode($res1,true);
        var_dump($res1);
        if($res1==null){
            echo "链接失败";
        }else{
            $code1=$res1["code"];
            if($code1==200) {
                $this->sendchenggong2($domain);
            }else{
                echo $messages="api2域名购买失败||";
                $this->shibai($domain);
            }
        }

    }


    public function internetbsregist($domain){
        $arrt=explode(".",$domain);
        $domains1=$this->getdomain("fr");
        $domains2=$this->getdomain("be");
        $domains3=array_merge($domains1,$domains2);
        if(!in_array($domain, $domains3)){
            echo "此域名不存在||";
        }else{
            $ress=$this->getUserByDomain($domain);
            if($ress!=[]){
                $users=$ress[array_rand($ress,1)];
                var_dump($users["user_id"]);

                $res1= file_get_contents("https://api.internet.bs/Domain/Create?ApiKey=".$users["apikey1"]."&Password=".$users["password"]."&Domain=".$domain."&CloneContactsFromDomain=".$users["clonedomain"]);
                var_dump($res1);
                if(strpos($res1,"product_0_status=SUCCESS")){
                    echo $messages=$domain."在internetbs购买成功";
                    $this->sendchenggong2($domain);
                    file_get_contents("http://47.101.150.74/QQstmp.php?title=".$domain."&content=".$messages."&to=".$users["email"]);
                }else{

                    echo $messages="internetbsregist域名购买失败||";
                    $this->neostrada($users["apikey"],$domain,$users["extent_id"],$users["holderid"]);
                }
            }else{echo "没有符合条件用户||";}
        }
    }


    public function versioRegist($domain){

        $arrt=explode(".",$domain);
        $domains1=$this->getdomain($arrt[1]);
        if(!in_array($domain, $domains1)){
            echo "此域名不存在||";
        }else{
            $ress=$this->getUserByDomain($domain);
            if($ress!=[]){
                $users=$ress[array_rand($ress,1)];
                var_dump($users["user_id"]);
                if($users["versio_userpwd"]==1||$users["versio_contentid"]==1||$users["versio_userpwd"]==""||$users["versio_contentid"]==""){
                    $this->neostrada($users["apikey"],$domain,$users["extent_id"],$users["holderid"]);

                }else{
                    $ch=curl_init();
                    $url = "https://www.versio.nl/api/v1/domains/".$domain;
                    $post_data =[
                        'years'=>"1",
                        "contact_id"=>$users["versio_contentid"],
                    ];
                    $data_string = json_encode($post_data);
                    $header=[
                        "Accept:application/json",
                        'Content-Length: '. strlen($data_string)
                    ];
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_USERPWD, $users["versio_userpwd"]);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                    echo $output = curl_exec($ch);
                    curl_close($ch);
                    $res1=json_decode($output,true);
                    var_dump($res1);
                    if($res1["success"]["code"]==200){
                        echo $messages=$domain."在versio购买成功||";
                        $this->sendchenggong2($domain);
                        file_get_contents("http://47.101.150.74/QQstmp.php?title=".$domain."&content=".$messages."&to=".$users["email"]);
                    }elseif($res1["error"]["message"]=="InsufficientFundsException"){
                        echo $messages="余额不足";
                        $this->neostrada($users["apikey"],$domain,$users["extent_id"],$users["holderid"]);
                    }
                }

            }else{echo "没有符合条件用户||";}
        }
    }
    public function getdomain($extend){
        $redismodel=new Redis();
        $redismodel->connect("127.0.0.1","6379");
        $redismodel->auth("yangyusheng1234");
        $domains=$redismodel->lrange( $extend."_domains", 0, -1 );
        $redismodel->close();
        $domains = array_unique($domains);
//        var_dump($domains);
        return $domains;
    }
    public function getvpsip(){
        $redismodel=new Redis();
        $redismodel->connect("127.0.0.1","6379");
        $redismodel->auth("yangyusheng1234");
        $index=rand(0,14);
        $ip= $redismodel->lindex('vpsip',$index);
        $redismodel->close();
        return $ip;
    }
    public function registnl(){
        $domains_nl=$this->getdomain("nl");
        if($domains_nl==[]){
            echo "没有可检测域名"."<br>";
            sleep(20);
        }else{
            foreach ($domains_nl as $domain){
                $nPID = pcntl_fork();
                if ($nPID == 0) {
                    $domain = trim($domain);
                    $res=[];
                    $res[$domain]=0;
                    $ip =  $this->getvpsip();
                    if(strlen($domain)>3){
                        $res[$domain] = file_get_contents("http://" . trim($ip) . "/checkaction.php?domain=" . $domain);
                        if ($res[$domain] == 1) {
                            echo "||".date("Y-m-d H:i:s",time()+3600*8).$domain."域名可注册";
                            $this->versioRegist($domain);
                        }
                    }
                    unset($res);
                    exit(0);
                }
            }
        }

    }
    public function dd24nl(){
        $domains_nl=$this->getdomain("nl");
        $domains_be=$this->getdomain("be");
        $domains_fr=$this->getdomain("fr");
        $domains=array_merge($domains_be,$domains_nl,$domains_fr);
        if($domains==[]||$domains[0]=="\n"||$domains[0]==""){
            echo "没有可检测域名"."<br>";
            sleep(20);
        }else{
            $domainstr=[];
            foreach ($domains as $tt){
                $domainstr[]=trim($tt);
            }
            $domainstr1=implode(",",$domainstr);
            $ip =  $this->getvpsip();
            $url="http://".trim($ip)."/dd24.php?domains=".$domainstr1;
            $resjson= file_get_contents($url);
            $res=json_decode($resjson,true);
            foreach ($res as $k=>$v){
                if ($v == 1) {
                    echo "||".date("Y-m-d H:i:s",time()+3600*8).$k."域名可注册";
                    $domainsss=explode(".",trim($k));
                    if($domainsss[1]=="nl"){
                        $this->versioRegist($k);
                    }else{
                        $this->internetbsregist(trim($k));
                    }
                }else{
                    echo 0;
                }

            }
        }

    }
    public function registgnl(){
        $domains_nl=$this->getdomain("nl");
        if($domains_nl==[]){
            echo "没有可检测域名"."<br>";
            sleep(20);
        }else{
            foreach ($domains_nl as $domain){
                if(trim($domain)!=""){
                    $nPID = pcntl_fork();
                    if ($nPID == 0) {
                        $domain = trim($domain);
                        usleep(500000);
                        $res=[];
                        $res[$domain]=0;
                        $ip =  $this->getvpsip();
                        $res[$domain] = file_get_contents("http://" . trim($ip) . "/godaddy.php?domain=" . $domain);
                        if ($res[$domain] == 1) {
                            echo "||".date("Y-m-d H:i:s",time()+3600*8).$domain."域名可注册";
                            $this->versioRegist($domain);
                        }
                        unset($res);
                        exit(0);
                    }
                }else{
                    echo "域名不能为空||";
                }

            }
        }

    }
    public function registbe(){
        $domains_be1=$this->getdomain("be");
        $domains_fr=$this->getdomain("fr");
        $domains_be=array_merge($domains_be1,$domains_fr);
        if($domains_be==[]){
            echo "没有可检测域名"."<br>";
            sleep(10);

        }else {
            foreach ($domains_be as $domain) {
                if(trim($domain)!=""){
                    $domain = trim($domain);
                    sleep(1);
                    $res=[];
                    $res[$domain]=0;
                    $ip =  $this->getvpsip();
                    echo $ip;
                    if(strlen($domain)>3) {
                        $res[$domain] = file_get_contents("http://" . trim($ip) . "/checkaction.php?domain=" . $domain);
                        if ($res[$domain] == 1) {
                            echo date("Y-m-d H:i:s",time()+3600*8).$domain."域名可注册";
                            $this->internetbsregist($domain);
                        }
                        unset($res);
                    }
                }else{
                    echo "域名不能为空||";
                }

            }
        }

    }
    public function registgbe(){
        $domains_be1=$this->getdomain("be");
        $domains_fr=$this->getdomain("fr");
        $domains_be=array_merge($domains_be1,$domains_fr);
        if($domains_be==[]){
            echo "没有可检测域名"."<br>";
            sleep(10);

        }else {
            foreach ($domains_be as $domain) {
                if(trim($domain)!="") {
                    $nPID = pcntl_fork();
                    if ($nPID == 0) {
                        $domain = trim($domain);
                        sleep(1);
                        $res = [];
                        $res[$domain] = 0;
                        $ip =  $this->getvpsip();
                        $res[$domain] = file_get_contents("http://" . trim($ip) . "/godaddy.php?domain=" . $domain);
                        if ($res[$domain] == 1) {
                            echo date("Y-m-d H:i:s",time()+3600*8).$domain."域名可注册";
                            $this->internetbsregist($domain);
                        }
                        unset($res);
                        exit(0);
                    }
                }else{
                    echo "域名不能为空||";
                }
            }
        }

    }
    public function send(){
        $domains=$this->getdomain("send");
        if($domains==[]){
            echo "没有可检测域名"."<br>";
            sleep(10);
        }else {
            foreach ($domains as $domain) {
                $domain = trim($domain);
                sleep(0.9);
                $res=[];
                $res[$domain]=0;
                $ip =  $this->getvpsip();
                $res[$domain] = file_get_contents("http://" . trim($ip) . "/godaddy.php?domain=" . $domain);
                echo $domain."****". $res[$domain]."||";
                if ($res[$domain] == 1) {
                    $content=$domain."可注册";
                    $ress=[];
                    $pdo=$this->getpdo();
                    $pdo->query('set names utf8');
                    $query=$pdo->prepare("select *  from domains where is_send=11 AND Domain=?");
                    $query->execute([$domain]);
                    $ress=$query->fetchAll();
                    $pdo=null;
                    if($ress!=[]&&isset($ress)){
                        foreach ($ress as $res){
                            file_get_contents("http://47.101.150.74/QQstmp.php?title=".$domain."&content=".$content."&to=".$res["email"]);
                        }
                        $pdo=$this->getpdo();
                        $pdo->query('set names utf8');
                        $query=$pdo->prepare("update domains set is_send = 12 where domain=? AND is_send = 11");
                        $res=$query->execute([$domain]);
                        $pdo=null;
                    }else{
                        echo 1;
                    }

                }
                unset($res);
            }
        }

    }

}
