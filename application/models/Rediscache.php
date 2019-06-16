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
        $nlapikeys=$checkmodel->getNlApikey();
        $redismodel=new redis();
        $redismodel->connect("127.0.0.1","6379");
        $redismodel->auth("yangyusheng1234");
        $redismodel->delete("domains");
        $redismodel->delete("nlapikeys");
        $redismodel->delete("be_domains");
        $redismodel->delete("fr_domains");
        $redismodel->delete("send_domains");
        $nlfile=fopen($_SERVER['DOCUMENT_ROOT']."/download/nl.txt","w");
        $befile=fopen($_SERVER['DOCUMENT_ROOT']."/download/be.txt","w");
        $frfile=fopen($_SERVER['DOCUMENT_ROOT']."/download/fr.txt","w");
        $sendfile=fopen($_SERVER['DOCUMENT_ROOT']."/download/send.txt","w");
        var_dump($domains);
        foreach ($domains as $domain){
            $domain_extent=explode(".",$domain);
            if($domain_extent[1]=="be"){
                $redismodel->rPush("be_domains",$domain);
                fwrite($befile,$domain."\n");
            }elseif($domain_extent[1]=="nl"){
                $redismodel->rPush("domains",$domain);
                fwrite($nlfile,$domain."\n");
            }elseif($domain_extent[1]=="fr"||$domain_extent[1]=="it"||$domain_extent[1]=="ch"||$domain_extent[1]=="cz"){
                $redismodel->rPush("fr_domains",$domain);
                fwrite($frfile,$domain."\n");
            }
        }
        foreach ($senddomains as $domain){
            $redismodel->rPush("send_domains",$domain);
            fwrite($sendfile,$domain."\n");
        }

        fclose($nlfile);
        fclose($befile);
        fclose($frfile);
        fclose($sendfile);
        $fen=date("i",time());
        if($fen>15&&$fen<43){
            $befile=fopen($_SERVER['DOCUMENT_ROOT']."/download/be.txt","w");
            fwrite($befile,"");
            fclose($befile);
        }


        foreach ($nlapikeys as $nlapikey){
            $redismodel->rPush("nlapikeys",$nlapikey[0].":".$nlapikey[1]);
        }
        $redismodel->close();
    }

}
