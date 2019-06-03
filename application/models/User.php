<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author pc-201707241653\administrator
 */
class UserModel {
    public $errno=0;
    public $errmsg="123";
    public function __construct() {
        $db_ms='mysql';  //数据库类型
        $db_host='localhost';  //主机地址
        $db_user='root';  //数据库账号
        $yangconfig=file($_SERVER['DOCUMENT_ROOT']."/download/paw.txt");
        $paw=trim($yangconfig[0]);
        $db_pass=$paw;  //数据库密码
        $this->db_pass=$paw;
        $db_name='user'; //数据库名
        $dbh=$db_ms.':host='.$db_host.';'.'dbname='.$db_name;
        $this->pdo=new PDO($dbh,$db_user,$db_pass);
        $this->pdo->query('set names utf8');

    }
    public function adduser($name,$password){
        $name=trim($name);
        $password=trim($password);
        if(!$name||!$password){
            $this->errno=0;
            $this->errmsg="用户名和账户不能为空";
        }else{
            $querySelect=$this->pdo->prepare("select * from user where name=?");
            $querySelect->execute([$name]);
            if($querySelect->fetchAll()){
                $this->errno=0;
                $this->errmsg="用户名已存在";
            }else{
                $query=$this->pdo->prepare("insert into user (name,password) values (?,?)");
                if($query->execute([$name,$password])){
                    $this->errno=1;
                    $this->errmsg="注册成功";
                    $query=$this->pdo->prepare("select * from user where name=?");
                    $query->execute([$name]);
                    $res=$query->fetchAll();
                    return $res[0]["id"];
                }else{
                    $this->errno=0;
                    $this->errmsg="注册失败";
                }
            }
        }
    }

    public function check($name,$password){
        $name=trim($name);
        $password=trim($password);
        if(!$name||!$password){
            $this->errno=0;
            $this->errmsg="用户名和账户不能为空";
        }else{
            $query=$this->pdo->prepare("select * from user where name=? and password=?");
            $query->execute([$name,$password]);
            if($res=$query->fetchAll()){

                $this->errno=1;
                $this->errmsg="登录成功";
                return $res[0]["id"];
            }else{
                $this->errno=0;
                $this->errmsg="账号或密码错误";
            }
        }
    }

    public function checkPassword($password,$password1){
        if(!$password||!$password1){
            $this->errno=0;
            $this->errmsg="密码不能为空";
        }elseif ($password!=$password1) {
            $this->errno=0;
            $this->errmsg="输入密码不一致";
        }else{
            $query=$this->pdo->prepare("update user set password=? where id=?");
            session_start();
           if ($query->execute([$password,$_SESSION["id"]])){
               $this->errno=1;
               $this->errmsg="修改成功";
           }else{
               $this->errno=0;
               $this->errmsg="修改失败";
           }
        }
    }

}
