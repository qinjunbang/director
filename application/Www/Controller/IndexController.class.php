<?php
namespace Www\Controller;
use Spartan\Core\Controller;

!defined('APP_PATH') && exit('404 Not Found');

class IndexController extends Controller {

    public function index(){
        $options = Array(
            'where'=>Array(
                'id'=>Array('in',Array("10",'22'))
            )
        );
        $arrList = $this->Dal()->select('member_auth',$options);
        print_r($arrList);

        print_r($this->Dal()->Db()->getLastSql());
        //$this->display();
    }

    public function update(){
        $arrData = Array(



        );

        $result = $this->Dal()->update('web_activity',$arrData);
    }

    public function select(){
        $options = Array(
            'where'=>Array(
                'id'=>Array('in',Array("10",'22',111,132))
            )
        );
        $arrList = $this->Dal()->delete('web_activity',$options);
        print_r($arrList);
        print_r($this->Dal()->Db()->getLastSql());
    }
}