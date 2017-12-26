<?php
/*
*项目的基础配置，如果使用SVN或GIT更新生产环境，忽略该文件即可，非常实用
*/
defined('APP_PATH') or die('404 Not Found');
return Array(
    'SITE'=>Array(//站点设置
        'NAME'=>'Spartan主页',
        'KEY_NAME'=>'spartan,framework,db orm',
        'DESCRIPTION'=>'spartan是一个轻量级的PHP框架，非常非常地轻；部署非常常方便。',
    ),
    'DB'=>Array(//数据库设置
        'TYPE'=>'mysqli',//数据库类型
        'HOST'=>'120.78.80.218',//服务器地址
        'NAME'=>'syt_pay',//数据库名
        'USER'=>'syt_pay',//用户名
        'PWD'=>'syt_pay',//密码
        'PORT'=>'3306',//端口
        'PREFIX'=>'j_',//数据库表前缀
        'CHARSET'=>'utf8',//数据库编码默认采用utf8
    ),
    'SESSION_HANDLER'=>Array(//Session服务器，如果启用，可以共享session
        'OPEN'=>false,
        'NAME'=>'redis',
        'PATH'=>'tcp://120.78.80.218:63798?auth=foobaredf23fdafasflxvxz.vaf;jdsafi2pqfjaf;;dsafj;sajfsapfisapjf',
    ),
    'EMAIL'=>Array(//邮件服务器配置
        'SERVER'=>'smtp.exmail.qq.com',
        'USER_NAME'=>'',
        'PASS_WORD'=>'',
        'PORT'=>25,
        'FROM_EMAIL'=>'',//发件人EMAIL
        'FROM_NAME'=>'Mrs Syt', //发件人名称
    ),
);