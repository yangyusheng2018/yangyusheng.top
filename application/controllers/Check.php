<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/14
 * Time: 11:34
 */
class CheckController extends Yaf_Controller_Abstract
{

    public function gocheckAction()
    {
        $checkmodel=new CheckModel();
        $results=$checkmodel->getUsers();
        if($results!=[]){
            foreach ($results as $result){
                $stmp=new SmtpModel();
                $stmp->test("域名可注册","域名可注册".$result["Domain"],$result["con_email"]);
                $domainmodel=new DomainsModel();
                $domainmodel->toIsSend($result["Domain"]);

            }
        }

//        print_r($results);
        return false;
    }
    public function redistestAction(){
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1","6379");
        $redismodel->set("test","str1");
        return false;
    }
    public function goredisAction(){
        $rdiscachemodel=new RediscacheModel();
        $rdiscachemodel->gocache1();
        return false;
    }
    public function testAction(){
        $registmodel=new RegistModel();
        $res=$registmodel->toregist();
        var_dump($res);
        return false;
    }
    public function godaddytestAction(){
        $registmodel=new RegistModel();
        $res=$registmodel->togodaddyregist();
        var_dump($res);
        return false;
    }

    public function be_testAction(){
        $registmodel=new RegistModel();
        $res=$registmodel->toregistbe();
        var_dump($res);
        return false;
    }
    public function be_godaddytestAction(){
        $registmodel=new RegistModel();
        $res=$registmodel->togodaddyregistbe();
        var_dump($res);
        return false;
    }
    public function api2testAction(){
        $registmodel=new RegistModel();
        $res=$registmodel->api2goregist();
        var_dump($res);
        return false;
    }
    public function registnewnlAction(){
        $registmodel=new RegistnewModel();
        $registmodel->registnl();
        return false;
    }
    public function registnewbeAction(){
        $registmodel=new RegistnewModel();
        $registmodel->registbe();
        return false;
    }
    public function ceshiAction(){
        $registmodel=new UserModel();
        echo $registmodel->db_pass;
        return false;
    }


}