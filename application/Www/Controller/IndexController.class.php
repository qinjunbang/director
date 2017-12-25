<?php
namespace Www\Controller;
use Spartan\Core\Controller;

!defined('APP_PATH') && exit('404 Not Found');

class IndexController extends Controller {

    public function index(){
        $arrList = $this->Db()->select('member_auth');
        print_r($arrList);
        $this->display();
    }

}