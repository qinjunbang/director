<?php
namespace Rpc\Logic\Dal\Web;
use Rpc\Logic\Dal\Dal;
use Spartan\Extend\Validate;

class Introduction extends Dal
{
	public $table = 'web_introduction';
    public $condition = Array(
        'a.site_id'=>Array('int'),
        'file_name'=>Array('str'),
        'tpl_name'=>Array('str'),
        'title'=>Array('str'),
        'key_word'=>Array('str'),
        'status'=>Array('int'),
        'is_hide'=>Array('int'),
        'a.add_time'=>Array('int')
    );
	/**
	 * 读取单一记录，返回一个记录的Array();
	 */
	public function find(){
		$intId = max(0,intval($this->getData('id')));
        $strAction = $this->getData('action','');
        if ($strAction == 'combo'){
            $options = Array(
                'alias' => 'a',
                'field'=>'title,content',
                'where' => Array(
                    'id' => $intId
                ),
            );
        }else{
            $options = Array(
                'alias' => 'a',
                'where' => Array(
                    'id' => $intId
                ),
                'field'=>'*',
            );
        }
		return $this->getResult($options);
	}

	/**
	 * 读取一个列表记录，返回一个列表的Array();
	 */
	public function select(){
		$strAction = $this->getData('action','');
		if ($strAction=='combo'){
			$options = Array(
                'alias' => 'a',
				'field'=>'id,name,tip',
			    'limit'=>1000,
			);
		}else{
			$options = array(
				'field'=>'*',
                'alias' => 'a',
			);
		}
		return $this->getResult($options,'select');
	}

	/**
	 * 添加和修改，返回的Data中，0-是【更新成功】或【最后插入ID】，1-是所有的SQL语句
	 */
	public function update(){
		$intID = max(0,intval($this->getData('id')));
		$arrData = array(
			'site_id'=>[max(0,$this->getData('site_id'))],
			'file_name'=>[trim($this->getData('file_name')),'length','访问地址2-20',2,20],
			'tpl_name'=>[trim($this->getData('tpl_name')),'length','名称应该为2-30',2,30],
			'title'=>[trim($this->getData('title')),'length','名称应该为2-100',2,100],
			'key_word'=>[trim($this->getData('key_word')),'length','名称应该为2-100',2,100],
			'description'=>[trim($this->getData('description')),'length','名称应该为2-200',2,200],
			'content'=>[trim($this->getData('content'))],
			'add_time'=>time(),
			'status'=>[max(0,$this->getData('status'))],
			'page_key'=>[trim($this->getData('page_key')),'length','名称应该为2-20',2,20],
			'sort'=>[max(0,$this->getData('sort'))],
			'is_hide'=>[max(0,$this->getData('is_hide'))],
		);
		if (!Validate::instance($arrData)){
			return $arrData;
		}
		if ($intID > 0 ){
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
	/**
	 * 删除记录。
	 */
	public function delete(){
		$strId = $this->getData('id');
		if(!is_numeric(str_ireplace(',','',$strId))){
			return Array("删除ID不明确！",0);
		}
        $options = Array('alias' => 'a');
		$options['where'] = Array('id'=>Array('IN',$strId));
		return $this->getResult($options,'delete');
	}
}