<?php
class httpport {
    public function nldns($domain){
        $fp = @fsockopen( "whois.sidn.nl", 43, $errno, $errstr, 20) or die("Socket Error " . $errno . " - " . $errstr);
        fputs($fp, $domain . "\r\n");
        $out = "";
        while(!feof($fp)){
            $out .= fgets($fp);
        }
        fclose($fp);
        $data=explode("\r\n",$out);
        if(isset($data[1])){
            $status=str_replace(" ","",$data[1]);
        }
        if(strpos($data[0],'is free')){
            $res=1;
        }elseif ($status=="Status:active"){
            $res=-1;
        }elseif ($status=="Status:inquarantine"){
            $res=0;
        }
       echo $res;
    }
    public function dnsbe($domain){
        //加载bewhois 服务器
        $fp = @fsockopen("whois.dns.be", 43, $errno, $errstr, 20) or die("Socket Error " . $errno . " - " . $errstr);
        //添加域名
        fputs($fp, $domain. "\r\n");
        $out = "";
        while(!feof($fp)){
            $out .= fgets($fp);
        }
        fclose($fp);
        //将输出文档转化成数组
        $data=explode("\r\n",$out);
        //获取年份
        $years=explode(" ",trim($data[38]));
        //判断域名是否 可注册  判断域名是否被抢注
        if(trim($data[37])=="Status:	NOT AVAILABLE"&& $years[3]!=date("Y")){
            $res=0;
        }elseif (trim($data[37])=="Status:	NOT AVAILABLE"&& $years[3]==date("Y")){
            $res=-1;
        }elseif (trim($data[37])=="Status:	AVAILABLE"){
            $res=1;
        }
       echo $res;
    }
    public function dnscheck($domain){
        $whoisdns=array(
            "com" => array("whois.verisign-grs.com","whois.crsnic.net"),
            "net" => array("whois.verisign-grs.com","whois.crsnic.net"),
            "org" => array("whois.pir.org","whois.publicinterestregistry.net"),
            "info" => array("whois.afilias.info","whois.afilias.net"),
            "biz" => array("whois.neulevel.biz"),
            "us" => array("whois.nic.us"),
            "uk" => array("whois.nic.uk"),
            "ca" => array("whois.cira.ca"),
            "tel" => array("whois.nic.tel"),
            "ie" => array("whois.iedr.ie","whois.domainregistry.ie"),
            "it" => array("whois.nic.it"),
            "li" => array("whois.nic.li"),
            "no" => array("whois.norid.no"),
            "cc" => array("whois.nic.cc"),
            "eu" => array("whois.eu"),
            "nu" => array("whois.nic.nu"),
            "au" => array("whois.aunic.net","whois.ausregistry.net.au"),
            "de" => array("whois.denic.de"),
            "ws" => array("whois.worldsite.ws","whois.nic.ws","www.nic.ws"),
            "sc" => array("whois2.afilias-grs.net"),
            "mobi" => array("whois.dotmobiregistry.net"),
            "pro" => array("whois.registrypro.pro","whois.registry.pro"),
            "edu" => array("whois.educause.net","whois.crsnic.net"),
            "tv" => array("whois.nic.tv","tvwhois.verisign-grs.com"),
            "travel" => array("whois.nic.travel"),
            "name" => array("whois.nic.name"),
            "in" => array("whois.inregistry.net","whois.registry.in"),
            "me" => array("whois.nic.me","whois.meregistry.net"),
            "at" => array("whois.nic.at"),
            "be" => array("whois.dns.be"),
            "cn" => array("whois.cnnic.cn","whois.cnnic.net.cn"),
            "asia" => array("whois.nic.asia"),
            "ru" => array("whois.ripn.ru","whois.ripn.net"),
            "ro" => array("whois.rotld.ro"),
            "aero" => array("whois.aero"),
            "fr" => array("whois.nic.fr"),
            "se" => array("whois.iis.se","whois.nic-se.se","whois.nic.se"),
            "nl" => array("whois.sidn.nl","whois.domain-registry.nl"),
            "nz" => array("whois.srs.net.nz","whois.domainz.net.nz"),
            "mx" => array("whois.nic.mx"),
            "tw" => array("whois.apnic.net","whois.twnic.net.tw"),
            "ch" => array("whois.nic.ch"),
            "hk" => array("whois.hknic.net.hk"),
            "ac" => array("whois.nic.ac"),
            "ae" => array("whois.nic.ae"),
            "af" => array("whois.nic.af"),
            "ag" => array("whois.nic.ag"),
            "al" => array("whois.ripe.net"),
            "am" => array("whois.amnic.net"),
            "as" => array("whois.nic.as"),
            "az" => array("whois.ripe.net"),
            "ba" => array("whois.ripe.net"),
            "bg" => array("whois.register.bg"),
            "bi" => array("whois.nic.bi"),
            "bj" => array("www.nic.bj"),
            "br" => array("whois.nic.br"),
            "bt" => array("whois.netnames.net"),
            "by" => array("whois.ripe.net"),
            "bz" => array("whois.belizenic.bz"),
            "cd" => array("whois.nic.cd"),
            "ck" => array("whois.nic.ck"),
            "cl" => array("nic.cl"),
            "coop" => array("whois.nic.coop"),
            "cx" => array("whois.nic.cx"),
            "cy" => array("whois.ripe.net"),
            "cz" => array("whois.nic.cz"),
            "dk" => array("whois.dk-hostmaster.dk"),
            "dm" => array("whois.nic.cx"),
            "dz" => array("whois.ripe.net"),
            "ee" => array("whois.eenet.ee"),
            "eg" => array("whois.ripe.net"),
            "es" => array("whois.ripe.net"),
            "fi" => array("whois.ficora.fi"),
            "fo" => array("whois.ripe.net"),
            "gb" => array("whois.ripe.net"),
            "ge" => array("whois.ripe.net"),
            "gl" => array("whois.ripe.net"),
            "gm" => array("whois.ripe.net"),
            "gov" => array("whois.nic.gov"),
            "gr" => array("whois.ripe.net"),
            "gs" => array("whois.adamsnames.tc"),
            "hm" => array("whois.registry.hm"),
            "hn" => array("whois2.afilias-grs.net"),
            "hr" => array("whois.ripe.net"),
            "hu" => array("whois.ripe.net"),
            "il" => array("whois.isoc.org.il"),
            "int" => array("whois.isi.edu"),
            "iq" => array("vrx.net"),
            "ir" => array("whois.nic.ir"),
            "is" => array("whois.isnic.is"),
            "je" => array("whois.je"),
            "jp" => array("whois.jprs.jp"),
            "kg" => array("whois.domain.kg"),
            "kr" => array("whois.nic.or.kr"),
            "la" => array("whois2.afilias-grs.net"),
            "lt" => array("whois.domreg.lt"),
            "lu" => array("whois.restena.lu"),
            "lv" => array("whois.nic.lv"),
            "ly" => array("whois.lydomains.com"),
            "ma" => array("whois.iam.net.ma"),
            "mc" => array("whois.ripe.net"),
            "md" => array("whois.nic.md"),
            "mil" => array("whois.nic.mil"),
            "mk" => array("whois.ripe.net"),
            "ms" => array("whois.nic.ms"),
            "mt" => array("whois.ripe.net"),
            "mu" => array("whois.nic.mu"),
            "my" => array("whois.mynic.net.my"),
            "nf" => array("whois.nic.cx"),
            "pl" => array("whois.dns.pl"),
            "pr" => array("whois.nic.pr"),
            "pt" => array("whois.dns.pt"),
            "sa" => array("saudinic.net.sa"),
            "sb" => array("whois.nic.net.sb"),
            "sg" => array("whois.nic.net.sg"),
            "sh" => array("whois.nic.sh"),
            "si" => array("whois.arnes.si"),
            "sk" => array("whois.sk-nic.sk"),
            "sm" => array("whois.ripe.net"),
            "st" => array("whois.nic.st"),
            "su" => array("whois.ripn.net"),
            "tc" => array("whois.adamsnames.tc"),
            "tf" => array("whois.nic.tf"),
            "th" => array("whois.thnic.net"),
            "tj" => array("whois.nic.tj"),
            "tk" => array("whois.nic.tk"),
            "tl" => array("whois.domains.tl"),
            "tm" => array("whois.nic.tm"),
            "tn" => array("whois.ripe.net"),
            "to" => array("whois.tonic.to"),
            "tp" => array("whois.domains.tl"),
            "tr" => array("whois.nic.tr"),
            "ua" => array("whois.ripe.net"),
            "uy" => array("nic.uy"),
            "uz" => array("whois.cctld.uz"),
            "va" => array("whois.ripe.net"),
            "vc" => array("whois2.afilias-grs.net"),
            "ve" => array("whois.nic.ve"),
            "vg" => array("whois.adamsnames.tc"),
            "yu" => array("whois.ripe.net")
        );
        $domainarr=explode(".",$domain);
        $fp = @fsockopen( $whoisdns[$domainarr[1]][0], 43, $errno, $errstr, 20) or die("Socket Error " . $errno . " - " . $errstr);
        fputs($fp, $domain . "\r\n");
        $out = "";
        while(!feof($fp)){
            $out .= fgets($fp);
        }
        fclose($fp);
        $data1=[];
        $data=explode("\n",$out);
        for($i=0;$i<40;$i++){
            $data[$i]=str_replace(["\n","\r"],"",$data[$i]);
            if($data[$i]!=""&&substr_count($data[$i],"%")==0&&substr_count($data[$i],":")&&substr($data[$i], -1)!=":"&&substr_count($data[$i],"http")==0){
                $data[$i]="\"".str_replace([": ",":	"],"\":\"",$data[$i])."\"";
                $data1[]=str_replace([" ","\n","\r"],"",$data[$i]);
            }
        }
        $data2=implode(",",$data1);
        $data2="{".$data2."}";
        $array=json_decode($data2,true);
        $res=0;
        if($domainarr[1]=="fr"){
            if($array==[]){
                $res=1;
            }elseif ($array["status"]=="REDEMPTION"){
                $res=0;
            }elseif ($array["status"]=="REGISTERED"){
                $res=-1;
            }
        }elseif($domainarr[1]=="nl"){
            if($array==[]){
                $res=1;
            }elseif($array["Status"]=="inquarantine"){
                $res=0;
            }elseif($array["Status"]=="active"){
                $res=-1;
            }
        }elseif($domainarr[1]=="be"){
            if($array["Status"]=="AVAILABLE"){
                $res=1;
            }elseif($array["Status"]=="NOTAVAILABLE"){
                if(substr($array["Registered"], -4)==date("Y",time())){
                    $res=-1;
                }else{
                    $res=0;
                }
            }
        }elseif($domainarr[1]=="it"){
            if($array["Status"]=="AVAILABLE"){
                $res=1;
            }elseif($array["Status"]=="ok"){
                $res=-1;
            }elseif($array["Status"]=="pendingDelete/redemptionPeriod"){
                $res=0;
            }
        }elseif($domainarr[1]=="de"){
            if($array["Status"]=="free"){
                $res=1;
            }elseif($array["Status"]=="connect"){
                $res=-1;
            }elseif($array["Status"]=="redemptionPeriod"){
                $res=0;
            }
        }
        echo $res;
    }



    public function registbs($domain,$clonedomain,$apikey,$password){
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="it"){
            $itparameter="&registrant_clientip=104.248.147.202&registrant_dotitterm1=yes&registrant_dotitterm2=yes&registrant_dotitterm3=yes&registrant_dotitterm4=yes";
        }else{
            $itparameter="";
        }
        $out=file_get_contents("https://api.internet.bs/Domain/Create?ApiKey=".$apikey."&Password=".$password."&Domain=".$domain."&CloneContactsFromDomain=".$clonedomain.$itparameter);
        $datas=explode("\n",$out);
        foreach ($datas as $data){
            $data=str_replace("\"","",$data);
            $data1[]='"'.str_replace("=",'":"',$data).'"';
        }
        echo $jsonstr="{".implode(",",$data1)."}";
//        var_dump(json_decode($jsonstr,true));
    }
}

$model=new httpport();
if($_GET["action"]=="nldns"){
    $model->nldns($_GET["domain"]);
}elseif ($_GET["action"]=="dnsbe"){
    $model->dnsbe($_GET["domain"]);
}elseif ($_GET["action"]=="registbs"){
    $model->registbs($_GET["domain"],$_GET["clonedomain"],$_GET["apikey"],$_GET["password"]);
}elseif ($_GET["action"]=="dnscheck"){
    $model->dnscheck($_GET["domain"]);
}

