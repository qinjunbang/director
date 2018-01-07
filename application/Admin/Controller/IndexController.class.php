<?php
namespace Admin\Controller;
use Admin\Common\Control;
use Spartan\Lib\Image;

!defined('APP_PATH') && exit('404 Not Found');

class IndexController extends Control {
    /**
     * 显示登录后的后台操作首页
     */
    public function index(){
        $this->assign('info',$this->adminInfo);
        $this->display('index');
    }

    /**
     * 登录界面和登录操作
     */
    public function login(){
        if($this->getUrl(2,'default') != "save"){
            $this->display('login');die();
        }
        //如果是提交登录
        $arrData = Array(
            'user_name'=>Array('required','length',[2,32],'请输入正确的用户名。'),
            'pass_word'=>Array('required','length',[6,32],'请输入正确的密码。'),
            'code'=>Array('required','same',['$session.verifyCode'],'错误的验证码，请输入正确的验证码。'),
       );
        list($arrData,$arrResult) = $this->valid($arrData)->result();
        if ($arrResult['status'] != 1){
            $this->ajaxReturn($arrResult);
        }
        $arrResult = $this->logic()->User('/Admin/Users/login',$arrData);
        $arrInfo = isset($arrResult['data'])?$arrResult['data']:[];
        if ($arrResult['status'] == 1 && isset($arrInfo['id'])){
            if ($arrInfo['status'] != 1){
                $this->ajaxReturn(Array('status'=>0,'info'=>'该帐号还没有激活!'));
            }else{
                session('admin_info', $arrInfo);
                $this->ajaxReturn(Array('status'=>1));
            }
        }elseif ($arrResult['status'] == 2 && isset($arrInfo['id'])){
            session("admin_edit", $arrInfo);
            $this->ajaxReturn(Array('status'=>2,'info'=>'登录成功。密码太简单，请修改密码!'));
        }else{
            $this->ajaxReturn($arrResult);
        }
    }

    public function reg(){
        if($this->getUrl(2,'default') != "save"){
            $this->display('reg');die();
        }
    }

    public function lost(){
        if($this->getUrl(2,'default') != "save"){
            $this->display('lost');die();
        }
    }

    /**
     * 显示验证码。
     */
    public function code(){
        Image::instance();
    }
    /**
     * 退出登录
     */
    public function logout(){
        session('admin_info', null);
        echo "<script language='javascript'>window.parent.location.href='/';</script>退出登录。。";
    }

    /**
     * 修改用户初始密码。
     */
    public function editPass(){
        $arrInfo = session("admin_edit");
        if(!$arrInfo){
            $this->error("登录超时，请重新登录。",'/index/login');
        }
        $this->assign('info',$arrInfo);
        $action = $this->getUrl(2,'default');
        if ($action != "save"){
            $this->assign('action',$action);
            $this->display();die();
        }
        $arrData = Array(
            'pass_word'=>[I('post.upass'),'length','密码应该在6-32位之间。',6,32],
            're_pass_word'=>[I('post.upass2'),'length','密码应该在6-32位之间。',6,32],
            'id'=>$arrInfo['id'],
            'user_name'=>$arrInfo['user_name'],
        );
        !Validate::instance($arrData) && $this->ajaxMessage($arrData['info']);
        if (is_numeric($arrData['pass_word']) && mb_strlen($arrData['pass_word'],'UTF-8')<8){
            $this->ajaxMessage('纯数字的密码长度不能小于8位。');die();
        }
        if ($arrData['pass_word'] != $arrData['re_pass_word']){
            $this->ajaxMessage('两次输入的密码不相同。');die();
        }
        $arrInfo = postData('/Admin/AdminInfo/editPass',$arrData);
        if ($arrInfo['status'] == 1){
            session('admin_edit',null);
            session('admin_info',null);
        }
        $this->ajaxReturn($arrInfo);
    }

}