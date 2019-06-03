<?php
/**
 * @name IndexController
 * @author pc-201707241653\administrator
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class SmtpController extends Yaf_Controller_Abstract {

	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yang/index/index/index/name/pc-201707241653\administrator 的时候, 你就会发现不同
     */
    public function sendemailAction(){
file_get_contents("http://47.101.150.74/QQstmp.php?title=123&content=123&to=1611337277@qq.com");
        return false;
    }

	public function testAction(){
	    $testdomain='12312323423.nl';
	    echo array_pop(explode(".",$testdomain));
	    return false;
    }
}
