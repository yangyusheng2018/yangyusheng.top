<?php
echo 111;
$filename=$_GET["filename"];
echo $action=$_GET["action"];
if($action=="delete"){
    unlink("/home/0000_DenyIP/DenyIP/".$filename);
}elseif ($action=="create"){
    $name="/home/0000_DenyIP/DenyIP/".$filename;
    $f=fopen($name,"w+");
    fwrite($f,$_GET["content"]);
    fclose($f);
}elseif ($action=="wget"){
    unlink("/home/0000_DenyIP/DenyIP/".$_GET["filename1"]);
    $content=file_get_contents("http://yangyusheng.top/download/".$filename);
    $name="/home/0000_DenyIP/DenyIP/".$_GET["filename1"];
    $f=fopen($name,"w+");
    fwrite($f,$content);
    fclose($f);

}elseif ($action=="allfile"){
    echo $dir  =  dirname(__FILE__);
    //判断目标目录是否是文件夹
    $file_arr = array();
    if(is_dir($dir)){
        //打开
        if($dh = @opendir($dir)){
            //读取
            while(($file = readdir($dh)) !== false){

                if($file != '.' && $file != '..'){
                    $file_arr[] = $file;
                }

            }
            //关闭
            closedir($dh);
        }
    }
    echo "<pre>";
    foreach ($file_arr as $v){
        echo $v."<br>";
    }
    print_r($file_arr);
}elseif ($action=="rename"){
    rename($_GET["filename"],$_GET["filename2"]);
}

