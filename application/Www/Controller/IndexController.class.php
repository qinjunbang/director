<?php
namespace Www\Controller;
use Spartan\Core\Controller;

!defined('APP_PATH') && exit('404 Not Found');

class IndexController extends Controller {

    public function index(){
        $objCls = $this->Db()->find('test');

        $this->display();
    }

}