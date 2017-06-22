/**
 * Created by bjwsl-001 on 2017/5/10.
 */
//获取新闻列表
(function(){
    $(function(){
        var p=0;//屏幕
        $.ajax({
            url:"ajax/selectNews.php",
            data:{pagenum:0},
            success:chuli
        })//初始化ajax
        //初始化的六个内容
        $(".more").bind("click",function(){
            p++;
            $.ajax({
                url:"ajax/selectNews.php",
                data:{pagenum:p},
                success:chuli
            })//初始化ajax
        })
    })


  function chuli(d){
      var str='';
      if(d.data.length<6){
          $(".more").remove();
          $(".mei").css("display","block")
          //return;
      }
      for(var i=0;i< d.data.length;i++){
       str+='<li><div class="txt"><h2> ' +
          '<a href="newsdetail.html?id='+ d.data[i].id+'">'+d.data[i].title+'</a> ' +
          '</h2> <p class="desc">'+ d.data[i].desc+'</p><p class="date">发布时间：'+d.data[i].date+' </p></div><div class="pic"> <a href="newsdetail.html?id='+ d.data[i].id+'"> ' +
          '<img src="ajax/upload/'+d.data[i].src+'" alt=""/> ' + '</a></div></li>';
      }
    $("ul.news").append(str);
  }


})()


//