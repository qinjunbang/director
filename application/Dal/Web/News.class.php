<?php
namespace Rpc\Logic\Dal\Web;
use Rpc\Logic\Dal\Dal;
use Spartan\Extend\Validate;

class News extends Dal
{
	public $table = 'web_news';
    public $condition = Array(
        'a.site_id'=>Array('int'),
        'type_id'=>Array('int'),
        'title'=>Array('str'),
        'sub_title  '=>Array('str'),
        'status'=>Array('int'),
        'hot'=>Array('int'),
        'hits'=>Array('int'),
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
                'field' =>'b.*,a.*',
                'join'  =>'@.web_news_type as b on a.type_id=b.id',
                'order' => 'a.id desc',
            );
		}else{
            $options = Array(
                'alias' => 'a',
                'field'=>'*',
                'where'=>'',
                'order'=>'a.id asc'
            );
        }
        $options['page'] = max(1,$this->getData('page'));
        $options['limit'] = max(10,$this->getData('page_size'));
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
			'type_id'=>[max(0,$this->getData('type_id')),'gt','请选择大类。',0],
			'title'=>[$this->getData('title'),'length','请输入标题',2],
			'content'=>[$this->getData('content')],
			'status'=>[max(0,$this->getData('status'))],
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