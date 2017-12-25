<?php
/*
*项目的常用、公共的配置
*/
defined('APP_PATH') or die('404 Not Found');
$arrConfig = include('BaseConfig.php');
$arrTemp =  Array(

);
return array_merge($arrConfig,$arrTemp);