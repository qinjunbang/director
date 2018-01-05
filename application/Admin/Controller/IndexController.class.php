<?php
namespace Admin\Controller;
use Spartan\Core\Controller;

!defined('APP_PATH') && exit('404 Not Found');

class IndexController extends Controller {

    public function index(){
        $this->display();
    }

}