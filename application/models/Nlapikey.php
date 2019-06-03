<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 20:35
 */

class NlapikeyModel{

    public $errno=0;
    public $errmsg="123";
    public function __construct() {
        $db_ms='mysql';  //数据库类型
        $db_host='localhost';  //主机地址
        $db_user='root';  //数据库账号
        $yangconfig=file($_SERVER['DOCUMENT_ROOT']."/download/paw.txt");
        $paw=trim($yangconfig[0]);
        $db_pass=$paw;  //数据库密码
        $db_name='user'; //数据库名
        $dbh=$db_ms.':host='.$db_host.';'.'dbname='.$db_name;
        $this->pdo=new PDO($dbh,$db_user,$db_pass);
        $this->pdo->query('set names utf8');
    }
    public function apikeyList(){
        session_start();
        $query=$this->pdo->prepare("select * from nlapikey WHERE user_id=?");
        $query->execute([$_SESSION["id"]]);
        $res=$query->fetchAll();
        return $res;
    }
    public function check($keys,$password,$start_time,$end_time){
            session_start();
            $querys=$this->pdo->prepare("select * from  nlapikey where nlkeys=?");
            $querys->execute([$keys]);
            if($querys->fetchAll()){
                $this->errno=0;
                $this->errmsg="key已存在";
            }else{
                $start_time=strtotime($start_time);
                $end_time=strtotime($end_time);
                $query=$this->pdo->prepare("insert into  nlapikey (nlkeys,password,user_id,start_time,end_time) values (?,?,?,?,?)");
                if($query->execute([$keys,$password,$_SESSION["id"],$start_time,$end_time])){
                    $this->errno=1;
                    $this->errmsg="添加成功";
                }else{
                    $this->errno=0;
                    $this->errmsg="添加失败";
                }
            }
    }

    public function seleteByKeys($id){
        $query=$this->pdo->prepare("select * from  nlapikey where id=?");
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

    public function updatekey($keys,$password,$id,$start_time,$end_time){
        $start_time=strtotime($start_time);
        $end_time=strtotime($end_time);
            $query=$this->pdo->prepare("update  nlapikey set start_time=?,end_time=?, nlkeys=?,password=? where id=? and user_id=?");
            session_start();
            if ($query->execute([$start_time,$end_time,$keys,$password,$id,$_SESSION["id"]])){
                $this->errno=1;
                $this->errmsg="修改成功";
            }else{
                $this->errno=0;
                $this->errmsg="修改失败";
            }
    }

    public function deletekey($id){
        session_start();
        $query=$this->pdo->prepare("delete from  nlapikey where id=? and user_id=?");
        if($query->execute([$id,$_SESSION["id"]])){
            $this->errno=1;
            $this->errmsg="删除成功";
        }else{
            $this->errno=0;
            $this->errmsg="删除失败";
        }
    }

    public function deletebykey($nlkeys,$password){
        $query=$this->pdo->prepare("delete from  nlapikey where nlkeys=? and password=?");
        if($query->execute([$nlkeys,$password])){
            $this->errno=1;
            $this->errmsg="删除成功";
        }else{
            $this->errno=0;
            $this->errmsg="删除失败";
        }
    }

    public function getallapi(){
        $query=$this->pdo->prepare("select * from nlapikey");
        $query->execute();
        $res=$query->fetchAll();
        return $res;
    }

}