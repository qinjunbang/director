<?php
namespace Rpc\Logic\Dal\Web;
use Rpc\Logic\Dal\Dal;

class Activity extends Dal
{
	public $table = 'web_activity';
    public $condition = Array(
        'a.site_id'=>Array('int'),
        'a.type_id'=>Array('int'),
        'name'=>Array('str'),
        'content'=>Array('str'),
        'a.status'=>Array('int'),
        'a.begin_time'=>Array('int'),
        'a.end_time'=>Array('int'),
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
		if ($strAction == 'manager'){
			$options = Array(
                'alias' => 'a',
                'order' => 'a.id desc',
                'page'=>max(1,$this->getData('page')),
                'limit'=>max(10,$this->getData('page_size')),
            );
		}else{
            $options = Array('alias' => 'a');
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
		    'site_id'=>max(0,intval($this->getData('site_id'))),
			'name' => $this->getData('name'),
            'status' => $this->getData('status'),
            'type_id' => $this->getData('type_id'),
            'begin_time' => $this->getData('begin_time'),
            'end_time' => $this->getData('end_time'),
            'value_info' => json_encode($this->getData('value_info'), JSON_UNESCAPED_UNICODE),
            'content' => $this->getData('content'),
		);
        if (empty($arrData['name'])){
            return array('活动名称不能为空!',0);
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