<?php
namespace Admin\Common;
use Spartan\Core\Controller;

!defined('APP_PATH') && exit('404 Not Found');
/**
 * @description
 * @author singer
 * @date 15-4-2 下午2:27
 */
abstract class Control extends Controller {
	protected $adminInfo = null;
	//protected $rpcClient = null;

	public function __construct(){
		parent::__construct();
		$this->checkAccess();
	}

	private function checkAccess(){
        $this->adminInfo = session('?admin_info')?session('admin_info'):['id'=>0,'user_name'=>'noLogin'];
        if ($this->adminInfo['id'] < 1 && !$this->whiteList()){
            if (isAjax()){
                $this->ajaxReturn(['info'=>'Please Sign In.','status'=>0]);
            }else{
                redirect('/index/login');die();
            }
        }
    }

    private function whiteList(){
	    $arrUrl = Array(
	        'index/login',
	        'index/code',
            'index/editpass'
        );
        return in_array(strtolower(__URL__),$arrUrl);
    }

} 