<?php
/**
 * @name IndexController
 * @author pc-201707241653\administrator
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class WhoisController extends Yaf_Controller_Abstract {


    //获取nl whois信息
    public function testAction(){
//        $whois=new WhoisModel;
//        echo $out=$whois->getdata1("aladdinzwolle.nl");
        echo 1;
//        $out=file_get_contents("http://yangyusheng.nl/nlwhois.php?domain=vermeervlaardingen.nl");
//        $curl = curl_init();
////设置抓取的url
//        curl_setopt($curl, CURLOPT_URL, "https://www.baidu.com");
////设置头文件的信息作为数据流输出
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($curl, CURLOPT_POST, false);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//        $out = curl_exec($curl);
//        curl_close($curl);
        $out=file_get_contents("https://www.baidu.com/");
        echo $out;
        return false;
    }
    public function getedateAction(){
        $domain=$this->getRequest()->Get('domain');
        if($domain==""){
            echo json_encode(["err"=>0,"msg"=>"域名不能为空"],JSON_UNESCAPED_UNICODE);
        }else{
            $domainarr=explode(".",$domain);
            if($domainarr[1]!="nl"){
                echo json_encode(["err"=>0,"msg"=>"必须是nl后缀"],JSON_UNESCAPED_UNICODE);
            }else{
                $whois=new WhoisModel;
                $out="";
                $out=$whois->whoislookup($domain);
                if(strpos($out,"Socket Error")){
                    $out=file_get_contents("http://yangyusheng.nl/nlwhois.php?domain=".$domain);
                }

                preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}/",$out,$arr);
                $str=$arr[0];
                if($str==""){
                    echo json_encode(["err"=>0,"msg"=>"获取失败"],JSON_UNESCAPED_UNICODE);
                }else{
                    $str=str_replace("T"," ",$str);
                    $start_time=date("Y-m-d H:i:s",(strtotime($str)+3600*8));
                    $end_time=date("Y-m-d H:i:s",(strtotime($str)+3600*9));
                    echo json_encode(["err"=>1,"start_time"=>$start_time,"end_time"=>$end_time,"msg"=>"获取成功"],JSON_UNESCAPED_UNICODE);
                }
            }


        }

            return false;
    }



}
