<?php
namespace Dal\Web;

class Activity
{
    //表名
	public $strTable = 'web_activity';
    //表备注
    public $strComment = '活动表';
	//别名
	public $strAlias = 'a';
	//唯一主键
	public $strPrimaryKey = 'id';
	//支持外露的查询条件
    public $arrCondition = Array(
        'id'=>Array('int'),
        'site_id'=>Array('int'),
        'type_id'=>Array('int'),
        'name'=>Array('str'),
        'content'=>Array('str'),
        'status'=>Array('int'),
        'begin_time'=>Array('time'),
        'end_time'=>Array('time'),
        'add_time'=>Array('time'),
    );
    /**
     * 添加时必的字段，执行update时检查的
     * @var array
     */
    public $arrRequired = Array(
        'name'=>Array('required','length',Array(2,10),'请输入名称'),
        'content'=>Array('required','length',Array(2,100),'请输入活动内容'),
        'begin_time'=>Array('nullable','date',Array(2,100),'请输入活动内容'),
        'end_time'=>Array('nullable','date',Array(2,100),'请输入活动内容'),
        'add_time'=>Array('nullable','date',Array(2,100),'请输入活动内容'),
    );

    /**
     * 所有的字段名
     * [类型,长度,小数,主键,默认值,注释]
     * @var array
     */
    public $arrFields = Array(
        'id'=>Array('int',10,0,true,true,0,'主键ID'),
        'site_id'=>Array('int',10,0,true,false,0,'活动列表，0为全站，ID为分站'),
        'type_id'=>Array('int',10,0,true,false,0,'主键ID'),
        'name'=>Array('varchar',80,0,true,false,0,'活动名称'),
        'content'=>Array('varchar',255,0,true,false,0,'活动的详情'),
        'img_info'=>Array('varchar',100,0,true,false,0,'图片'),
        'to_url'=>Array('varchar',100,0,true,false,0,'跳转URL'),
        'status'=>Array('tinyint',3,0,true,false,0,'1，有效，2无效'),
        'begin_time'=>Array('int',10,0,true,false,0,'开始时间'),
        'end_time'=>Array('int',10,0,true,false,0,'结束时间'),
        'value_info'=>Array('varchar',200,0,true,false,0,'变量列表，json_info内容'),
        'add_time'=>Array('int',10,0,true,false,0,'添加时间'),
    );
}