<?php
/**
 * @name IndexController
 * @author pc-201707241653\administrator
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class NlapikeyController extends Yaf_Controller_Abstract {
    public function apikeyvAction(){
        $NlapikeyModel=new NlapikeyModel();
        $res=$NlapikeyModel->apikeyList();
        $this->_view->assign( ["res"=>$res]);
        return true;
    }
    public function apiAddvAction(){
        return true;
    }

    public function apiAddAction(){
        $keys=$this->getRequest()->getPost("keys");
        $password=$this->getRequest()->getPost("password");
        $start_time=$this->getRequest()->getPost("start_time");
        $end_time=$this->getRequest()->getPost("end_time");
        $usermodel=new NlapikeyModel();
        $usermodel->check($keys,$password,$start_time,$end_time);
        echo json_encode(['errno'=>$usermodel->errno,'errmsg'=>$usermodel->errmsg]);
        return false;
    }

    public function apikeyvEditAction(){
        $id=$this->getRequest()->Get('id');
        $NlapikeyModel=new NlapikeyModel();
        $res=$NlapikeyModel->seleteByKeys($id);
        $this->_view->assign( ["res"=>$res]);
        return true;
    }
    public function apikeyEditAction(){
        $keys=$this->getRequest()->getPost("keys");
        $password=$this->getRequest()->getPost("password");
        $id=$this->getRequest()->getPost("id");
        $start_time=$this->getRequest()->getPost("start_time");
        $end_time=$this->getRequest()->getPost("end_time");
        $NlapikeyModel=new NlapikeyModel();
        $NlapikeyModel->updatekey($keys,$password,$id,$start_time,$end_time);
        echo json_encode(['errno'=>$NlapikeyModel->errno,'errmsg'=>$NlapikeyModel->errmsg]);
        return false;
    }
    public function deleteAction(){
        $id=$this->getRequest()->Get("id");
        $NlapikeyModel=new NlapikeyModel();
        $NlapikeyModel->deletekey($id);
        echo json_encode(['errno'=>$NlapikeyModel->errno,'errmsg'=>$NlapikeyModel->errmsg]);
        return false;
    }
}



