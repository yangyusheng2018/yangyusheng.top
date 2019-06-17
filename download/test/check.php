<?php
class ApischeckModel {

    public $errno=0;
    public $errmsg="123";
    public function __construct() {
    }
    public function godaddy($domain){
        $keys=[
            "dLiW4LvErgT2_ASQ9L1jeKNDy6Lk5jHzLK7:ASQBRcugdLSdM6rRZhZ3KK",
            "dLiW4LvGJf4w_VnvyfMRRFxXWeHrG1LNnef:Vnw2imKohNwYRfJCNJCuEj",
            "dLiW4LvGKKeh_TGNE9a1fWCRwxs6nGnCVde:TGNHDpDznCzogMzysBcbhv",
            "dLiW4LvGKfWg_K3PNsVCoxGq7H6wcmqhfvM:K3PSBtgDUHz1rnYHJk5dG9",
            "dLiW4LvGM1Hh_Guj6JeaGAHDbqvZpeGxHLQ:Guj9KZYp5wB9pueyJv2RTr",
            "dLiW4LvHmyEd_MLD6hesZfvnLH6hW1UKa64:MLD9pQ1jThofnyxVJCVecx",
            "dLiW4M2eyF1J_EYWhhA51PLDnUa7dp55N77:EYWjsm6iiqMQL6wZ38A22Z",
            "dLiW4M2eyaV6_Lddnp2HpcLNWcydfDV2mNq:LddrL66TrbezGTZzzZcbXX",
            "dLiW4M2eyutd_SPPEgABPdvnJ9ugMbSg7Vo:SPPJSPF78CepfaKAK2Dnv1",
            "dLiW4M2gQsmD_X5dKgkAAbHjmbf5x3yXxcv:X5dNAqgjXA4k3tRP9HvRki",
            "dLiW4M2gQsmD_2ENKeQbjPbUiLUb1xzVooo:2ENMQ2M5bS3YC9q4Eozj93",
            "dLiW4M2gRYCE_8MXc9VhSfHucazwzJ7QkPj:8MXfytJtLWYGmJr7AttPEy",
            "dLiW4M2gRsq1_Div3ac3ButBQrpSeZakzHZ:Div7Xf8CHp2gW9xsHtvZ2T",
            "dLiW4M2gSDh2_MXts1L3AaqKBaohWyvQbaX:MXtuNm6AozRYa1QrDi78pf",
            "dLiW4M2gSZKk_Sq3opKqAzPM3gWZL5UBmpS:Sq3ryZuBHvprznB74X7pox",
            "dLiW4M2gTDbv_4nsrwb6H5BofMqJd8nJqcZ:4nsty2ibCDGBwx9eoywbBj",
            "dLiW4M2gTZ5q_BuCeZYvRBMyLaFC6DBLUpe:BuCgKzyiDngzN3tPiSRPe6",
            "dLiW4M2gTZcf_JcT4Qan4gUEg5JKnCKzPzK:JcT6SriKe5r2bYd56yD93h",
            "dLiW4M2gTu6d_SCpBrpRmtmVFR6xBPLaUei:SCpEb5DR4eQGjWz5R9vo42",
            "dLiW4M2hts3a_268GSdkFsQMNcEcasbpUry:268K7ZJ7gvf6C8qRyepqKT",
            "dLiW4M2huCgH_8PQMVdQcrsqktUYFxoJt5F:8PQQ842eAdgzfzQKNXZG57",
            "dLiW4M2huXrd_EMZHyubyhgMoQLnKfHq51x:EMZLy9xdxA1hX4xws3jEAz",
            "dLiW4M2hus7D_M8coG3QGGv97YfLQcHB2yT:M8dBWEfow1sG9hjCabyKHw",
            "dLiW4M2husZk_STBPzywsRQgJiiY1ee24Ux:STBTTiWjKKMUdgfJVxFvgp",
            "dLiW4M2hvCyM_2v9iZYNADG5KG1H5TYgF86:2v9n1Sd5GabfEqx75RL7qk",
            "dLiW4M2hvYE3_9BhBGNWm5TyH8xvKeBE9J5:9BhEyGLhDPEVv7k5RzRrmT",
            "dLiW4M2hwYty_Ns8JTnw6hu9AxpoJg4Q5c9:Ns8LTZwX9kJ3ggjotNrrCu",
            "dLiW4M2jPBjV_Tzvzq9PeZdpsPs6zUpdEhx:Tzw3W4wWPA8aymKqasdbAS",
            "dLiW4M2jPX8s_4bDxMemmkqb83XfJzs5XX4:4bDzVkseaaGG6g8SXbQCyt",
            "dLiW4M2jPrYQ_BAU37huoWuyjKzD2dRdScH:BAU6HnHkf3cNaPH4qv9V61",
            "dLiW4M2jQBwu_KhTpzzELahugDmCPFL5Twt:KhTszEazqBZaLVP1T5yd6v",
            "dLiW5qgH7zg7_MkxKsNa6jsHLZcayJcKnwR:MkxNqncp9knQkDKLGvdxcF",
            "dLiW5qgH8KrV_Sh9LCbWt2Bcy6gFtpyZAtd:Sh9P7gKp5iWjYmBCsXXNcd",
            "dLiW5qgH8LEU_WiVQHbypaCdXzTmppYoert:WiVTX1bZ4gsUyNeuxoffHS",
            "dLiW5qgH8fe7_7zcnCY5mbvgWgMqU5JhYhX:7zcos9ySnELNwGMvxUgX7X",
            "dLiW5qgH8ztf_CoqFYKFz9ESygh318VfmBp:CoqJFjjgUXDB4ycdvsS66v",
            "dLiW5qgH91CT_HW31r72B7MxHtZ9FBMmtoM:HW379TC4Ee7FFyE9h92dFh",
            "dLiW5qgH9LNj_A3d3bdV1nLZSvyqQVJFZrb:A3dcQrUS1pHrQbVV2JPL7M",
            "dLiW5qgJbK57_TJWywXk3QQvyq2WwSmThNq:TJX2FdZGHDS35iRDknpGg9",
            "dLiW5qgJbeQ9_3w7rwZEDviNqMUVgqquwRT:3w7uzy8cN8ns8qwdCok41X",
            "dLiW5qgJcKDD_EF292LmfMrFbsMTEQsPiKu:EF2BEcRGNXgsb9Bg6oeMDm",
            "dLiW5qgJcePS_Ld31KpJmR2H4uEntcLrNyE:Ld338mHtyDTCVRqyovhGFJ",
            "dLiW5qgJcyo4_SWQQeD6Y8uatAQkmmowZos:SWQSuoyvVwdTciJGPWYAeZ",
            "dLiW5qgJczQF_XYfHuHJuznhgSh3WXimwjg:XYfNUz1XEdFK9gVHTSj7sg",
            "dLiW5qgJdKWG_3nSF7snr4qPrtC6vzFm38Z:3nSJQceMugF7bco54Gy1Vw",
            "dLiW5qgL4Hkk_EURdSr9H4d2NsvnPXZr9Bb:EURfE8WWwdtrbrvxGGX3VF",
            "dLiW5qgL4xR4_UYHWS3wR6P5ZpFWRXjPcdq:UYHZ7ooDkVY7LHBXsDyxaX",
            "dLiW5qgL5HyQ_3zaYqKutiD8VDGBunMWNoL:3zacpsvjbuSEez4vCzRuzr",
            "dLiW5qgL5d9c_8aqvrSrL6KjtT9WZnZoBnu:8aqz4BrAudgBZoV8TwVDF3",
            "dLiW5qgL5dXf_CeSqQcgwZfWXCqmrF2grQm:CeSss3bcpMXqnpCksTuLa9",
            "dLiW5qgL5xwE_JX3b9QNHwF8DqS3uDvMrSJ:JX3dqAE6bMamMTj1ZQxCNz",
            "dLiW5qgL6JGH_ReChYWjRTWFAL7TepAExfw:ReCkrvCpyXQ4uo4KM4cv1j",
            "dLiW5qgL6Jir_WuUp2BnntzgXBoSXVg4bgt:WuUqq8mvTBremzVchFuUxx",
            "dLiW5qgL6dyS_4JkfKaWiaQMNttQEoroNBg:4Jkhcr1zcchcDSrFtSZwzn",
            "dLiW5qgL6yXr_CiAv2aCUybsnUrudP4ioRp:CiAxK1PpBE5BsHuPECuPki",
            "dLiW5qgL7K67_Kcoh9SBmWZXhveskxKDvU4:Kcom3zLwNivVmc3BzJdWkL",
            "dLiW5qgMYGf2_R4FuBhCbRsB6WjaWmprMhw:R4Fydu7h8QMHpZwvcaXcU5",
            "dLiW5qgMYbzB_3HWERhVYpeSH4ZieUa2djG:3HWGT97rwftoegZg9mfPJS",
            "dLiW5qgMYx9p_7EoY444ei8FNwB7d8aeUCM:7EoZc1UmBigdj41zADwWih",
            "dLiW5qgMZcRx_E8SW9aN13N2Esj5XSZBdQd:E8SYrAXkY4dcKtCu1VMxqX",
            "dLiW5qgMZd7f_MtT8PtBEpqKvoYywPW4kTJ:MtTCeRm6o8NZ3b1fz5Y8QY",
        ];
        $ch = curl_init();
        $url = "https://api.godaddy.com/v1/domains/available?domain=".$domain."&checkType=FAST&forTransfer=false";
        $header=[
            'accept: application/json',
            'Authorization: sso-key '.$keys[mt_rand(0,60)],
        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($ch);
        echo $output;
        curl_close($ch);
        $res=0;
        $data=json_decode($output,true);
        if($data["available"]==false){
            $res=0;
        }elseif ($data["available"]==true){
            $res=1;
        }
        return $res;
    }

    public function sidn($domain){
        $datajson=file_get_contents("https://api.sidn.nl/rest/is?domain=".$domain);
        $data=json_decode($datajson,true);
        var_dump($data);
        if($data["details"]["state"]["type"]=="FREE"){
            $res=1;
        }elseif($data["details"]["state"]["type"]=="QUARANTINE"){
            $res=0;
        }elseif($data["details"]["state"]["type"]=="ACTIVE"){
            $res=-1;
        }else{
            $res=-2;
        }
        var_dump($res);
        return $res;
    }
    public function creazy($domain){
        $res=0;
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="nl"){
            $search_tld="30";
            $josntype=1;
        }elseif ($domainarr[1]=="be"){
            $search_tld="13";
            $josntype=1;
        }elseif ($domainarr[1]=="fr"){
            $search_tld="23";
            $josntype=2;
        }elseif ($domainarr[1]=="it"){
            $search_tld="16";
            $josntype=1;
        }elseif ($domainarr[1]=="ch"){
            $search_tld="100";
            $josntype=2;
        }elseif ($domainarr[1]=="cz"){
            $search_tld="109";
            $josntype=2;
        }elseif ($domainarr[1]=="de"){
            $search_tld="33";
            $josntype=1;
        }
        $curl = curl_init();
        $url="https://cri".mt_rand(1,2).".secureapi.com.au/ajax/domain_get_availability.php?domain=".$domainarr[0]."&search_tld=".$search_tld."&tlds_to_search=".$domainarr[1];
        curl_setopt($curl, CURLOPT_URL, $url);
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $datajson = curl_exec($curl);
        curl_close($curl);
//    $datajon=file_get_contents("https://www.sidn.nl/rest/is?domain=".$domain);
        var_dump($datajson);
        var_dump($josntype);
        $data=explode(":",$datajson);
        if($josntype==1){
            if($data[1]=="0})"){
                $res=0;
            }elseif ($data[1]=="1})"){
                $res=1;
            }
        }else{
            $datajson= str_replace("(","",$datajson);
            $datajson= str_replace(")","",$datajson);
            $data=json_decode($datajson,true);
            if($data[$domain]["available"]==1){
                $res=1;
            }elseif ($data[$domain]["available"]==0){
                $res=0;
            }else{
                $res=3;
            }
        }

        return $res;
    }
    public function combaba($domain){
        $dnss=[
            "www.combaba.com",
            "domainin.supersite2.myorderbox.com",
            "comin.supersite2.china.myorderbox.com",
            "comin.supersite2.china.myorderbox.com",
        ];
        $res=0;
        $domainarr=explode(".",$domain);
        if($domainarr[1]=="nl"){
            $url="https://".$dnss[mt_rand(0,3)]."/domain-search.php?domain_names%5B%5D=".$domainarr[0]."&tlds%5B%5D=".$domainarr[1]."&action=multiple-check-availability";
            $datajson=file_get_contents($url);
            $data=json_decode($datajson,true);
            var_dump($data);
            if($data["data"][$domain]["status"]=="available"){
                $res=1;
            }else{
                $res=0;
            }
        }
        return $res;
    }
    public function lgium($domain){
        $domainarr=explode(".",$domain);
        $curl = curl_init();
//设置抓取的url
        curl_setopt($curl, CURLOPT_URL, "https://api.dnsbelgium.be/pubws/das?domain=".$domainarr[0]);
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $datajson = curl_exec($curl);
        curl_close($curl);
//    $datajon=file_get_contents("https://www.sidn.nl/rest/is?domain=".$domain);
        $data=json_decode($datajson,true);
        $status=$data["data"]["dasResults"]["be"]["status"];
        var_dump($status);
        if($status=="DELEGATED"){
            $res=0;
        }elseif ($status=="AVAILABLE"){
            $res=1;
        }
        return $res;
    }

    /**
     * @param $domain
     * 2019/5/26--17:09
     * @return int
     * 检测所有后缀
     */
    public function strato($domain){
//        https://www.strato.nl/orca/domain_name_search/get_domain_status/by_domain_name/strato/DE/123.nl
        $res=0;
        $curl = curl_init();
        $url="https://www.strato.nl/orca/domain_name_search/get_domain_status/by_domain_name/strato/DE/".$domain;
        curl_setopt($curl, CURLOPT_URL, $url);
//设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $datajson = curl_exec($curl);
        curl_close($curl);
        var_dump($datajson);

        if(strpos($datajson,'":0}}')){
            $res=1;
        }elseif (strpos($datajson,'":1}}')){
            $res=0;
        }else{
            $res=2;
        }
        return $res;

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
        echo $out;
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
        return $res;
    }
}

class RegistnewModel {

    public $errno=0;
    public $errmsg="123";
    public function __construct() {

    }

    public function getpdo(){
        $config=file("config.txt");
        $datapws=trim($config[2]);
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
        $arrt=explode(".",$domain);
        $content=file_get_contents("../".$arrt[1].".txt");
        echo $content;
        $content=str_replace($domain,"",$content);
        file_put_contents("../".$arrt[1].".txt",$content);
        $pdo=$this->getpdo();
        $query=$pdo->prepare("update domains set is_send = 6 where domain=? AND is_send = 0");
        $res=$query->execute([$domain]);
        $pdo=null;
        var_dump($res);
        echo "api购买成功";
    }
    public function shibai($domain){
//        $arrt=explode(".",$domain);
//        $content=file_get_contents("../".$arrt[1].".txt");
//        echo $content;
//        $content=str_replace($domain,"",$content);
//        file_put_contents("../".$arrt[1].".txt",$content);
        $pdo=$this->getpdo();
        $query=$pdo->prepare("update domains set is_send = is_send +1 where domain=?");
        $res=$query->execute([$domain]);
        $pdo=null;

    }

    public function userregist($domain){
        $arrt=explode(".",$domain);
        $domains1=$this->getdomain($arrt[1]);
        if(!in_array($domain."\n", $domains1)){
            echo "此域名不存在||";
        }else{
            $nowtime=time();
            $pdo=$this->getpdo();
            $pdo->query('set names utf8');
            $query=$pdo->prepare("select *  from domains where start_time<? and end_time>? and is_send<3 AND Domain=?");
            $query->execute([$nowtime,$nowtime,$domain]);
            $ress=$query->fetchAll();
            $pdo=null;
            if($ress!=[]){
                $result=0;
                $users=$ress[array_rand($ress,1)];
                var_dump($users["user_id"]);

                $ips = file("http://yangyusheng.top/download/vpsip.txt");
                $ip = $ips[mt_rand(0, count($ips))-1];
                echo $ip;
                $res1= file_get_contents("http://" . trim($ip) . "/registhttp.php?token=".$users["apikey"]."&domain=".$domain."&extent_id=".$users["extent_id"]."&holder_id=" .$users["holderid"]);

//                $res1=$this->nlapi2regist($domain,$users["apikey"],$users["extent_id"],$users["holderid"]);
                $res1=json_decode($res1,true);

                var_dump($res1);
                if($res1==null){
                    echo "链接失败";
//                    file_get_contents("http://yangyusheng.top/download/createiptxt.php");
                }else{
                    $code1=$res1["code"];
                    if($code1==200) {
                        $this->sendchenggong2($domain);
                    }else{
                        echo $messages="api2域名购买失败||";
                        $this->shibai($domain);
                    }
                }

            }else{echo "没有符合条件用户||";}
        }





    }
    public function getdomain($extend){
        $domains=[];
        $domains=file("http://yangyusheng.top/download/".$extend.".txt");

        $domains = array_unique($domains);
        return $domains;
    }

    public function registnl(){
        $domains_nl=$this->getdomain("nl");
        if($domains_nl==[]){
            echo "没有可检测域名"."<br>";
            sleep(20);
        }else{
            foreach ($domains_nl as $domain){
                $domain = trim($domain);
                $res=[];
                $res[$domain]=0;
                $ips = file("http://yangyusheng.top/download/vpsip.txt");
                $ip = $ips[mt_rand(1, count($ips))-1];
                echo $ip;
                if(strlen($domain)>3){
                    $res[$domain] = file_get_contents("http://" . trim($ip) . "/checkaction.php?domain=" . $domain);
//                    echo $res[$domain]."||";
                    echo $domain."****". $res[$domain]."||";
                    if ($res[$domain] == 1) {
                        echo date("Y-m-d H:i:s",time()+3600*8).$domain."域名可注册";
//                        echo $domain."****". $res[$domain]."||";
                        $this->userregist($domain);
                    }
                }
                unset($res);
            }
        }

    }
    public function dd24nl(){
        $domains_nl=$this->getdomain("nl");
        $domains_be=$this->getdomain("be");
        $domains=array_merge($domains_be,$domains_nl);
        if($domains==[]||$domains[0]=="\n"||$domains[0]==""){
            echo "没有可检测域名"."<br>";
            sleep(20);
        }else{
            $domainstr="";
            foreach ($domains as $domain){
                $domainstr=trim($domain).",";
            }
            $ips = file("http://yangyusheng.top/download/vpsip.txt");
            $ip = $ips[mt_rand(0, count($ips))-1];
            echo $ip;
            $resjson= file_get_contents("http://" . trim($ip) . "/dd24.php?domain=" . $domainstr);
            $res=json_decode($resjson,true);
            foreach ($res as $k=>$v){
                if ($v == 1) {
                    echo date("Y-m-d H:i:s",time()+3600*8).$k."域名可注册";
                    $this->userregist($k);
                }else{
                    echo $k."0000";

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
//                    $nPID = pcntl_fork();
//                    if ($nPID == 0) {
                    $domain = trim($domain);
                    sleep(2);
                    $res=[];
                    $res[$domain]=0;
                    $ips = file("http://yangyusheng.top/download/vpsip.txt");
                    $ip = $ips[mt_rand(1, count($ips))-1];
                    $res[$domain] = file_get_contents("http://" . trim($ip) . "/godaddy.php?domain=" . $domain);
                    echo $domain."****". $res[$domain]."||";
                    if ($res[$domain] == 1) {
                        $this->userregist($domain);
                    }
                    unset($res);
//                        exit(0);
//                    }
                }else{
                    echo "域名不能为空||";
                }

            }
        }

    }
    public function registbe(){
        $domains_be=$this->getdomain("be");
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
                    $ips = file("http://yangyusheng.top/download/vpsip.txt");
                    $ip = $ips[mt_rand(1, count($ips))-1];
                    echo $ip;
                    if(strlen($domain)>3) {
                        $res[$domain] = file_get_contents("http://" . trim($ip) . "/checkaction.php?domain=" . $domain);
//                    echo $res[$domain]."||";
                        echo $domain . "****" . $res[$domain] . "||";
                        if ($res[$domain] == 1) {
                            echo date("Y-m-d H:i:s",time()+3600*8).$domain."域名可注册";
//                        echo $domain."****". $res[$domain]."||";
                            $this->userregist($domain);
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
        $domains_be=$this->getdomain("be");
        if($domains_be==[]){
            echo "没有可检测域名"."<br>";
            sleep(10);

        }else {
            foreach ($domains_be as $domain) {
                if(trim($domain)!="") {
//                    $nPID = pcntl_fork();
//                    if ($nPID == 0) {
                    $domain = trim($domain);
                    sleep(1);
                    $res = [];
                    $res[$domain] = 0;
                    $ips = file("http://yangyusheng.top/download/vpsip.txt");
                    $ip = $ips[mt_rand(1, count($ips)) - 1];
                    $res[$domain] = file_get_contents("http://" . trim($ip) . "/godaddy.php?domain=" . $domain);
                    echo $domain . "****" . $res[$domain] . "||";
                    if ($res[$domain] == 1) {
                        $this->userregist($domain);
                    }
                    unset($res);
//                        exit(0);
//                    }
                }else{
                    echo "域名不能为空||";
                }
            }
        }

    }
    public function registfr(){
        $domains_fr=$this->getdomain("fr");
        if($domains_fr==[]){
            echo "没有可检测域名"."<br>";
            sleep(10);


        }else {
            foreach ($domains_fr as $domain) {
                $domain = trim($domain);
                sleep(0.9);
                $apicheckmodel = new ApischeckModel();
                $checkid = mt_rand(1, 4);
                switch ($checkid) {
                    case 1;
                        echo "dnscheck<br>";
                        $res = $apicheckmodel->dnscheck($domain);
                        break;
                    case 2;
                        echo "creazy<br>";
                        $res = $apicheckmodel->creazy($domain);
                        break;
                    case 3;
                        echo "strato<br>";
                        $res = $apicheckmodel->strato($domain);
                        sleep(0.1);
                        break;
                    case 4;
                        echo "lgium<br>";
                        $res = $apicheckmodel->lgium($domain);
                        sleep(0.1);
                        break;

                }
                if ($res == 1) {
                    $this->userregist($domain);
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
                $ips = file("http://yangyusheng.top/download/vpsip.txt");
                $ip = $ips[mt_rand(1, count($ips))-1];
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
//$model=new ApischeckModel();
//$model->godaddy("12gbethretjweg5ryk6u3.be");
