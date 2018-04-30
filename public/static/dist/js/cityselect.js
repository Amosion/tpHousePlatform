/**
 * Created by Amadeus on 2018/4/30.
 */
$(function(){
    var flag = 1;
    var once = function () {
        //只运行一次
        if(flag){
            //二级城市获取-点击二级
            city_id = $('#city').val();
            url = SCOPE.city_url;
            postData = {'id' : city_id};
            $.post(url,postData,function (res) {
                if(res.status === 1){
                    data = res.data;
                    city_html = "";
                    $(data).each(function () {
                        city_html += "<option value="+this.id+">"+this.name+"</option>";
                    });
                    $('#se_city').html(city_html);
                }else if(res.status === 0){
                    $('#se_city').html('');
                }
            });
            flag = 0;
        }
    };
    //二级城市获取-点击二级
    $('#se_city').click(function () {
        once();
    });
    //二级城市获取-点击一级
    $('#city').change(function () {
        city_id = $(this).val();
        url = SCOPE.city_url;
        postData = {'id' : city_id};
        $.post(url,postData,function (res) {
            if(res.status === 1){
                data = res.data;
                city_html = "";
                $(data).each(function () {
                    city_html += "<option value="+this.id+">"+this.name+"</option>";
                });
                $('#se_city').html(city_html);
            }else if(res.status === 0){
                $('#se_city').html('无');
            }
        },'json');
    });
});