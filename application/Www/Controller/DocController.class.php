<?php
namespace Www\Controller;
use Spartan\Core\Controller;

!defined('APP_PATH') && exit('404 Not Found');

class DocController extends Controller {

    public function index(){
        $arrFile = \Spt::loadDirFile(APP_ROOT.'Dal',true);
        $arrClass = [];
        foreach ($arrFile as $key=>$value){
            $clsTemp = new $value();
            $arrClass[$value] = $clsTemp;
            $arrFile[$key] .= '('.$clsTemp->strTable.')['.$clsTemp->strComment.']';
        }
        $this->assign('file',$arrFile);
        print_r($arrFile);
        $this->display();
    }

    public function _empty(){
        $strName = $this->getUrl(1);




    }
}