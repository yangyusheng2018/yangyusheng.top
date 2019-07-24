<?php
/**
 * @name SampleModel
 * @desc sample数据获取类, 可以访问数据库，文件，其它系统等
 * @author pc-201707241653\administrator
 */
class RediscacheModel {
    public function __construct() {
    }

    public function gocache1(){
        $checkmodel=new CheckModel();
        $domainsmodel=new DomainsModel();
        $domainsmodel->deletebytime();
        $domains=$checkmodel->getDomain();
        $senddomains=$checkmodel->getSendDomain();
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1","6379");
        $redismodel->auth("yangyusheng1234");
        $redismodel->delete("nl_domains");
        $redismodel->delete("be_domains");
        $redismodel->delete("fr_domains");
        $redismodel->delete("ch_domains");
        $redismodel->delete("send_domains");
        var_dump($domains);
        foreach ($domains as $domain){
            $domain_extent=explode(".",$domain);
            if($domain_extent[1]=="be"){
                $redismodel->rPush("be_domains",$domain);
            }elseif($domain_extent[1]=="nl"){
                $redismodel->rPush("nl_domains",$domain);
            }elseif($domain_extent[1]=="fr"||$domain_extent[1]=="it"||$domain_extent[1]=="cz"||$domain_extent[1]=="eu"||$domain_extent[1]=="ch"){
                $redismodel->rPush("fr_domains",$domain);
            }elseif($domain_extent[1]=="ch"){
                $domainsmodel1=new DomainsModel();
                $ress=$domainsmodel1->getUserByDomain($domain);
                foreach ($ress as $users){
                    $redismodel->rPush("ch_domains",$domain."----".$users["apikey1"]."----".$users["password"]."----".$users["clonedomain"]);
                }


            }
        }
        foreach ($senddomains as $domain){
            $redismodel->rPush("send_domains",$domain);
        }
        $fen=date("i",time());
        if($fen>15&&$fen<43){
            $redismodel->delete("be_domains");
        }
        $redismodel->close();
    }

}
