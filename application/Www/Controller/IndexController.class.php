<?php
namespace Www\Controller;
use Spartan\Core\Controller;

!defined('APP_PATH') && exit('404 Not Found');

class IndexController extends Controller {

    public function test(){
        //$arrInfo = $this->Dal()->Db()->getFullFields('member_account');
        //print_r($arrInfo);

//        $arrInfo = $this->Dal()->Db()->getFullFields('system_errors');
//        print_r($arrInfo);
//        $strInfo = 'public $arrFields = Array('.PHP_EOL;
//        foreach ($arrInfo as $k=>$v){
//            $strInfo .= "   Array('{$v[0]}',{$v[1]},{$v[2]},'{$v[3]}',{$v[4]},{$v[5]},{$v[6]},'{$v[7]}','{$v[8]}'),".PHP_EOL;
//        }
//        $strInfo .= ');'.PHP_EOL;
        $strInfo = $this->Dal()->Db()->showCreateTable('system_errors');
file_put_contents('text.php',implode(PHP_EOL,$strInfo));
        print_r($strInfo);
    }

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
        $result = $this->Validation()->authorize(
            Array(
                ''
            )
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