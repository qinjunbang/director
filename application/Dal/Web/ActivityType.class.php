<?php
namespace Rpc\Logic\Dal\Web;
use Rpc\Logic\Dal\Dal;
use Spartan\Extend\Validate;

class ActivityType extends Dal
{
	public $table = 'web_activity_type';
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
		$strAction = $this->getData('action', '');
		if ($strAction == 'manager') {
			$options = Array(//后台管理模型
                'alias' => 'a',
				'field' => '*',
				'where' => '',
				'order' => 'id asc',
                'page' => max(1, $this->getData('page')),
                'limit' => max(10, $this->getData('limit')),
			);
		} elseif ($strAction == 'combo') {
			$options = Array(
                'alias' => 'a',
				'field' => 'id,name as text,pid',
				'limit' => 200,
				'order' => 'id desc'
			);
		} else {
			$options = Array(
                'alias' => 'a',
				'field' => '*',
				'where' => '',
				'page' => max(1, $this->getData('page')),
				'limit' => max(10, $this->getData('limit')),
				'order' => 'id asc'
			);
		}
		return $this->getResult($options, 'select');
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
			'pid'=>max(0,$this->getData('pid')),
			'name'=>$this->getData('name',''),
			'sort'=>max(0,$this->getData('sort')),
		);

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