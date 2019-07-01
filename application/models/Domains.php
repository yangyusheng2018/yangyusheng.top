<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author pc-201707241653\administrator
 */
class DomainsModel {
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
    public function instertData($data){
        foreach ($data as $k=>$v){
            if(!$v){
                $isnull=0;
                break;
            }else{
                $datak[]=$k;
                $datav[]=$v;
                $dataprep[]="?";
                $isnull=1;
            }
        }
        if($isnull==0){
            $this->errmsg="数据不能为空";
            $this->errno="0";
        }else{
            $query=$this->pdo->prepare("insert into domains ".'('.implode(',', $datak).')'." values ".'('.implode(',', $dataprep).')');
            $prepar= "insert into domains ".'('.implode(',', $datak).')'." values ".'('.implode(',', $datav).')';
            if($query->execute($datav)){
                $this->errno=1;
                $this->errmsg="添加成功";
            }else{
                $this->errno=0;
                $this->errmsg="添加失败".$prepar;
            }
        }
//        return $this->errno;
    }

    public function add($data){
        session_start();
        $data["user_id"]=$_SESSION["id"];
        $domains=explode(",",$data["domain"]);
        $data["start_time"]=strtotime($data["start_time"]);
        $data["end_time"]=strtotime($data["end_time"]);
        unset($data["domain"]);
        foreach ($domains as $domainv) {
            $query=$this->pdo->prepare("select * from domains WHERE user_id=? and Domain=?");
            $query->execute([$_SESSION["id"],$domainv]);
            if($query->fetchAll()){
                $this->errno=0;
                $this->errmsg="域名已存在";
            }else{
            $data["Domain"] = $domainv;
            $this->instertData($data);
            if($this->errno==0){
                    $this->errno=0;
                    $this->errmsg=$domainv."添加失败1";
                    break;
                }else{
                    $this->errno=1;
                    $this->errmsg="添加成功";
                }
        }
        }
    }


    public function alllist(){
        session_start();
        $query=$this->pdo->prepare("select * from domains WHERE user_id=? and is_send<>11 and is_send<>12");

        $query->execute([$_SESSION["id"]]);
        $res=$query->fetchAll();
        return $res;
    }
    public function alllist1(){
        session_start();
        $query=$this->pdo->prepare("select * from domains WHERE user_id=? and (is_send=11 or is_send=12)");
        $query->execute([$_SESSION["id"]]);
        $res=$query->fetchAll();
        return $res;
    }
    public function seleteByKeys($id){
        $query=$this->pdo->prepare("select * from domains where id=?");
        $query->execute([$id]);
        if($res=$query->fetchAll()){
            $this->errno=1;
            $this->errmsg="查询成功";
            return $res[0];
        }else{
            $this->errno=0;
            $this->errmsg="查询失败";
        }
    }
    public function update($data){
        $data["start_time"]=strtotime($data["start_time"]);
        $data["end_time"]=strtotime($data["end_time"]);
        session_start();
        $datav[]=$data["id"];
        unset($data["id"]);
        foreach ($data as $k=>$v){
            if(!$v){
                $isnull=0;
                break;
            }else{
                $dataprep[]=$k."='".$v."'";
                $isnull=1;
            }
        }
        $datav[]=$_SESSION["id"];
        if($isnull==0){
            $this->errmsg="数据不能为空";
            $this->errno="0";
        }else{
            $query=$this->pdo->prepare("update domains set ".implode(',', $dataprep)." where id=? and user_id=?");
            $prepare="update domains set ".implode(',', $dataprep)." where id=? and user_id=?";
            if($query->execute($datav)){
                $this->errno=1;
                $this->errmsg="修改成功".$prepare;
            }else{
                $this->errno=0;
                $this->errmsg="修改失败";
            }
        }
    }
    public function delete($id){
        session_start();
        $query=$this->pdo->prepare("delete from domains where id=? and user_id=?");
        if($query->execute([$id,$_SESSION["id"]])){
            $this->errno=1;
            $this->errmsg="删除成功";
        }else{
            $this->errno=0;
            $this->errmsg="删除失败";
        }
    }
    public function toIsSend($domain){
        $query=$this->pdo->prepare("update domains set is_send = 1 where domain=?");
        $query->execute([$domain]);
        $logstr="";
        $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/logtxt.txt';
        $nowdate=date("Y-m-d H:i:s",time());
        $logstr=$nowdate."\n".$domain."已修改\n";
        file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
        ob_flush();flush();
    }
    public function toIsSend2($domain){
        echo "加载toIsSend2";
        $query=$this->pdo->prepare("update domains set is_send = 9 where domain=? AND is_send = 0");
        $res=$query->execute([$domain]);
        var_dump($res);
        $logstr="";
        $payLogFile = $_SERVER['DOCUMENT_ROOT'].'/logtxt.txt';
        $nowdate=date("Y-m-d H:i:s",time());
        $logstr=$nowdate."\n".$domain."已修改\n";
        file_put_contents($payLogFile, $logstr.PHP_EOL, FILE_APPEND);
        ob_flush();flush();
    }


    public function deletebytime(){
        $nowtime=time()-3600*12;
        $query=$this->pdo->prepare("delete from domains where end_time < ?");
        $query->execute([$nowtime]);
    }

    public function alldel($array){
        foreach ($array as $v){
            $this->delete($v);
        }
    }
}
