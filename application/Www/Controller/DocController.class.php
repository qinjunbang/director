<?php
namespace Www\Controller;
use Spartan\Core\Controller;
use Spartan\Lib\Document;

!defined('APP_PATH') && exit('404 Not Found');

class DocController extends Controller {
    private $config = [];

    public function __construct($startSession = true){
        parent::__construct($startSession);
        $this->config = C('SITE');
    }

    public function index(){

        $this->display('index');
    }

    /**
     * Dal目录下的数据表信息
     */
    public function dal(){
        $clsDocument = new Document(
            ['DOC_ROOT'=>APP_ROOT.'Dal']
        );
        $arrResult = $clsDocument->create();
        print_r($arrResult);
//        foreach ($arrFile as $key=>$value){
//            $clsTemp = new $value();
//            $arrClass[$value] = $clsTemp;
//            $arrFile[$key] .= '('.$clsTemp->strTable.')['.$clsTemp->strComment.']';
//        }
        $this->assign('config',$this->config);
        $this->display('doc');
    }

    /**
     * Logic目录下的逻辑层方法
     */
    public function logic(){
        $clsDocument = new Document(
            ['DOC_ROOT'=>APP_ROOT.'Logic']
        );
        $arrResult = $clsDocument->create();
        print_r($arrResult);
        $this->assign('list', $arrResult);
        $this->assign('config',$this->config);
        $this->display('doc');
    }

    /**
     * 当前Controller目录下，控制层的方法
     */
    public function controller(){


        $this->display('doc');
    }

    /**
     * 自定义查看其它项目Controller目录下的控制层方法
     */
    public function _empty(){
        $strName = $this->getUrl(1);




    }
}