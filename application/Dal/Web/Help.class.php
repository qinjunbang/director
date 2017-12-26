<?php
namespace Rpc\Logic\Dal\Web;
use Rpc\Logic\Dal\Dal;
use Spartan\Extend\Validate;

class Help extends Dal
{
	public $table = 'web_help';
    public $condition = Array(
        'a.site_id'=>Array('int'),
        'type_id'=>Array('int'),
        'title' => array('str'),
        'hot' => array('int'),
        'hits' => array('int'),
        'a.add_time' => array('int')
    );
	/**
	 * 读取单一记录，返回一个记录的Array();
	 */
	public function find(){
	    $intId = max(0,intval($this->getData('id')));
        $options = Array(
            'alias' => 'a',
            'where' => Array(
                'id' => $intId
            ),
            'field'=>'*',
        );
	    return $this->getResult($options);
    }
	/**
	 * 读取一个列表记录，返回一个列表的Array();
	 */
	public function select(){
		$strAction = $this->getData('action','');
		$strKeyWord = $this->getData('key_word','');
		if ($strAction == 'manager'){
			$options = Array(
                'alias' => 'a',
                'field' =>'b.*,a.*',
                'join'  =>'@.web_help_type as b on a.type_id=b.id',
                'order' => 'a.id desc',
            );
		}elseif ($strAction == 'help_index'){
            $options = Array(
                'alias' => 'a',
                'field'=>'*',
                'limit'=>10,
                'order'=>'hot,hits,a.id desc'
            );
        }else{
            $options = Array(
                'alias' => 'a',
                'field'=>'*',
                'page'=>max(1,$this->getData('page')),
                'limit'=>max(10,$this->getData('page_size')),
                'order'=>'a.id asc'
            );
        }
        $strKeyWord && $options['where']['title|content'] = Array('like',"%{$strKeyWord}%");
		return $this->getResult($options,'select');
	}
	/**
	 * 删除记录。
	 */
	public function delete(){
		$strId = $this->getData('id');
		if(!is_numeric(str_ireplace(',','',$strId))){
			return "删除ID不明确！";
		}
        $options = Array('alias' => 'a');
		$options['where'] = Array('id'=>Array('IN',$strId));
		return $this->getResult($options,'delete');
	}

	/**
	 * 添加和修改，返回的Data中，0-是【更新成功】或【最后插入ID】，1-是所有的SQL语句
	 */
	public function update(){
		$intID = max(0,intval($this->getData('id')));
		$arrData = array(
		    'site_id'=>max(0,intval($this->getData('site_id'))),
			'type_id'=>[max(0,$this->getData('type_id')),'gt','请选择大类。',0],
			'title'=>[$this->getData('title'),'length','请输入标题',2],
			'content'=>[$this->getData('content')],
			'hot'=>[max(0,$this->getData('hot'))],
			'hits'=>rand(2,4),
			'add_time'=>time(),
		);
		if(!Validate::instance($arrData)){
			return $arrData;
		}
		if ($intID > 0 ) {
			$options = Array(
				'where'=>array('id'=>$intID)
			);
			$result = $this->getResult($options,'update',$arrData);
		}else{
			$options = Array(
				'lock'=>false,
				'replace'=>false,
			);
			$result = $this->getResult($options,'insert',$arrData);
		}
		return $result;
	}
}