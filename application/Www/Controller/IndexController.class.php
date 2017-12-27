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

    public function select(){
        $options = Array(

        );
        $arrList = $this->Dal()->find('web_activity',$options);
        print_r($arrList);
        print_r($this->Dal()->Db()->getLastSql());
    }
}