<?php
namespace Rpc\Logic\Dal\Web;
use Rpc\Logic\Dal\Dal;
use Spartan\Extend\Validate;

class NewsType extends Dal
{
	public $table = 'web_news_type';
    public $condition = Array(
        'a.site_id'=>Array('int'),
        'pid'=>Array('int'),
        'name'=>Array('str'),
        'sort'=>Array('int'),
        'a.add_time'=>Array('int'),
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
		if ($strAction=='combo'){
			$options = Array(
                'alias' => 'a',
                'field'=>'id,pid,name as text',
			    'order'=>'pid,sort',
			    'limit'=>1000
			);
		}else{
            $options = Array(
                'alias' => 'a',
                'field'=>'*',
                'order'=>'pid,sort',
                'limit'=>10000
            );
		}
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
			'site_id'=>max(0,$this->getData('site_id')),
		    'pid'=>[max(0,$this->getData('pid'))],
			'name'=>[$this->getData('name'),'length','请输入2-50分类名',2,50],
			'sort'=>[max(0,$this->getData('sort'))],
		);
		if(!Validate::instance($arrData)) {
			return $arrData;
		}
		if ($intID > 0 ) {
			$options = Array(
				'where'=>array('id'=>$intID)
			);
			$result = $this->getResult($options,'update',$arrData);
		}else{
            $arrData['add_time'] = time();
			$options = Array(
				'lock'=>false,
				'replace'=>false,
			);
			$result = $this->getResult($options,'insert',$arrData);
		}
		return $result;
	}
}