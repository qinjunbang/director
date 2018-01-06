var path = '/public/AdminLTE-2.4.2/';//设置静态文件的引用地址
document.write('<link rel="stylesheet" href="'+path+'bower_components/bootstrap/dist/css/bootstrap.min.css">');
document.write('<link rel="stylesheet" href="'+path+'bower_components/font-awesome/css/font-awesome.min.css">');
document.write('<link rel="stylesheet" href="'+path+'bower_components/Ionicons/css/ionicons.min.css">');
document.write('<link rel="stylesheet" href="'+path+'dist/css/AdminLTE.min.css">');
document.write('<link rel="stylesheet" href="'+path+'plugins/iCheck/square/blue.css">');
document.write('<link rel="stylesheet" href="'+path+'cache/fonts.googleapis.com.css">');
document.write('<script src="'+path+'bower_components/jquery/dist/jquery.min.js" type="text/javascript"></sc'+'ript>');
document.write('<script src="'+path+'bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></sc'+'ript>');
document.write('<script src="'+path+'plugins/iCheck/icheck.min.js" type="text/javascript"></sc'+'ript>');

function showCode(img){
    if(!img){img='vcode';}
    if(!$('#'+img)){return;}
    $('#'+img).attr('src','/index/code?'+Math.random());
}