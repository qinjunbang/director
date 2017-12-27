<?php
namespace Dal\Web;

class Activity
{
    //表名
	public $strTable = 'web_activity';
	//别名
	public $strAlias = 'a';
	//唯一主键
	public $strPrimaryKey = '';
	//支持外露的查询条件
    public $arrCondition = Array(
        'a.id'=>Array('int'),
        'a.site_id'=>Array('int'),
        'a.type_id'=>Array('int'),
        'name'=>Array('str'),
        'content'=>Array('str'),
        'a.status'=>Array('int'),
        'a.begin_time'=>Array('int'),
        'a.end_time'=>Array('int'),
        'a.add_time'=>Array('int'),
    );
    //添加时必的字段
    public $arrRequired = Array(

    );
    //所有的字段名
    public $arrFields = Array(

    );
}