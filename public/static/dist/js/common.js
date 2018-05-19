/**
 * Created by Amadeus on 2018/4/30.
 */
//修改信息
function system_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
}
//否决信息
function system_deny(url){
    layer.confirm('确认否决吗？',function(){
        window.location.href = url;
    });
}
//删除信息
function system_del(url){
    layer.confirm('确认要删除吗？',function(){
        window.location.href = url;
    });
}