function showCode(img){
    if(!img){img='vcode';}
    if(!$('#'+img)){return;}
    $('#'+img).attr('src','/index/code?'+Math.random());
}

function saveForm(strUrl,strForm,objCallBack,intTip){
    if(!strForm){strForm = 'form1';}
    if(!intTip){intTip = 1;}
    var objForm = $("#"+strForm);
    if(objForm.length < 0){alert(strForm+'：表单不存在。');}
    var data = objForm.serialize();
    if (!data){alert(strForm+'：表单值为空。');}

    $.ajax({
        url: strUrl,type: 'post',data: data,dataType: 'json',
        error: function (text) {
            alert(text);
        },
        success: function(json) {
            if (typeof(objCallBack) == 'function'){objCallBack(json);}

            if(intTip == 1){}
        },
    });
}