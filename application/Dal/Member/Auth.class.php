<?php
namespace Dal\Member;

class Auth
{
    //表名
	public $strTable = 'member_auth';
	//别名
	public $strAlias = 'a';
	//唯一主键 = ['主键名',主键值]
	public $arrPrimaryKey = Array('id',0);
	//支持外露的查询条件
    public $arrCondition = Array(
        'a.id'=>Array('int'),
        'a.user_name'=>Array('int'),
    );
    //添加时必的字段
    public $arrRequired = Array(


    );
    //所有的字段名
    public $arrFields = Array(
        'id'=>'int',
        'site_id'=>'int',
        'user_name'=>'varchar',
        'email'=>'varchar',
        'mobile'=>'varchar',
        'pass_word'=>'varchar',
        'pay_word'=>'varchar',
        'status'=>'tinyint',
        'come_form'=>'tinyint',
        'role_id'=>'int',
        'grade_id'=>'int',
        'sex'=>'tinyint',
        'real_name'=>'varchar',
        'area_id'=>'varchar',
        'area_name'=>'varchar',
        'id_card'=>'varchar',
        'mobile_status'=>'tinyint',
        'email_status'=>'tinyint',
        'real_status'=>'tinyint',
        'pass_time'=>'int',
        'pay_time'=>'int',
        'reg_time'=>'int',
        'recommend_code'=>'varchar',
    );
}