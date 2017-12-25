<?php
/*
*站点的常用、公共的配置
*/
defined('APP_PATH') or die('404 Not Found');
$arrConfig = include(APP_ROOT.'Common'.NS.'Config.php');
$arrTemp = Array(

);
return array_merge($arrConfig,$arrTemp);