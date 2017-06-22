/**
 * Created by bjwsl-001 on 2017/5/11.
 */
(function(){
  $(function(){
      //头尾生成
     $(".header").load("header.html",function(){
        $(".header .nav a").removeClass("active").eq(5).addClass("active")
     })
     $(".footer").load("footer.html")
     //加载中间区域//

      var p=0;//第几屏幕
      var aid=""//区域
      var sid=""//街道


      //加载地区栏目
      $.ajax({
          url:"ajax/selectArea.php",
          data:{},
          success:areas
      })
    function areas(d){
        //console.dir(d);
        var str='<a href="javascript:void(0)" data-id="0" class="active no" title="不限">不限</a>';

        for(var i=0;i< d.data.length;i++){

         str+='<a href="javascript:void(0)" title="海淀" data-id="'+d.data[i].id+'">'+d.data[i].name+'</a>';
        }
         $(".area").append(str);
        //d.data.length;


        $(".area a").click(function(){
            p=0;
            $(".area a").removeClass("active")
            $(this).addClass("active")
            if($(this).is(".no")){
                aid="";sid="";
                $(".subarea").css("display","none");
            }else{
                $(".subarea").css("display","block");
                aid= this.dataset["id"];
                sid=""
                //给selectStreet发信息获取街道信息
            $.ajax({
                url:"ajax/selectStreet.php",
                data:{aid:aid},
                success:subs
             })

            }

            //给agent列表发信息表示改变
            $.ajax({
                url:"ajax/selectAgent.php",
                data:{
                    pagenum:p,
                    aid:aid,
                    sid:sid
                },
                success:chuli
            })

        })
    }

     function subs(d){
        //console.dir(d)
         var str='<a data-id="0" class="active no" href="javascript:void(0)" title="不限">不限</a>';
         for(var i=0;i< d.data.length;i++){
             str+='<a data-id="'+d.data[i].streetID+'" href="javascript:void(0)" title="'+d.data[i].streetName+'">'+d.data[i].streetName+'</a>';
         }
       $(".subarea").html(str);

       $(".subarea a").click(function(){
           p=0
           $(".subarea a").removeClass("active")
           $(this).addClass("active");
           if($(this).is(".no")){
              sid="";

           }else{
              sid=this.dataset["id"]

           }

           $.ajax({
               url:"ajax/selectAgent.php",
               data:{pagenum:p,
                   aid:aid,
                   sid:sid
               },
               success:chuli
           })


       })


     }


      //初始化发送一个屏幕
      $.ajax({
          url:"ajax/selectAgent.php",
          data:{
              pagenum:0,
              aid:aid,
              sid:sid
          },
          success:chuli
      })//初始化ajax


    function chuli(d){
        console.dir(d)
        var listr='';

        //d.data[0].aid
        //d.data[0].sid
       for(var i=0;i< d.data.length;i++){
           listr+='<li> ' +
           '<div class="pic"> ' +
           '<a href="agentdetail.html?id='+d.data[i].id+'"> ' +
           '<img src="ajax/upload/'+d.data[i].src+'" alt=""/> ' +
           '</a> ' +
           '</div> ' +
           '<div class="mid"> ' +
           '<h1>'+ d.data[i].agentName+'</h1> ' +
           '<p>主营板块：<span>'+ d.data[i].area+'</span>    <span>'+ d.data[i].street+'</span> </p> ' +
           '<div class="phone">'+d.data[i].agentPhone+' ' +
           '</div> ' +
           '</div> ' +
           '<div class="btn"> ' +
           '<a href="agentdetail.html?id='+d.data[i].id+'">进入TA的店铺</a> ' +
           '</div> ' +
           '</li>';

       }

         $("ul.list").html(listr)
         $(".total span").html(d.total);
       var maxpage= Math.ceil(d.total/6)
        var astr='<span class="disabled prev">上一页</span>';
        for(var i=0;i<maxpage;i++){
            if(i==0){
                astr+='<a href="javascript:void(0)" class="active">'+(i+1)+'</a>';
            }
            else{
            astr+='<a href="javascript:void(0)">'+(i+1)+'</a>';

            }
        }
        astr+='<span class="next">下一页</span>';
        $(".ctrl").html(astr);

       $(".ctrl .prev").addClass("disabled")
        if(maxpage<=1){
            $(".ctrl .next").addClass("disabled")
        }else{
            $(".ctrl .next").removeClass("disabled")
        }
       $(".ctrl a").click(function(){
           p=parseInt($(this).html())-1
           if(maxpage<=1){
               $(".ctrl .prev").addClass("disabled")
               $(".ctrl .next").addClass("disabled")
           }
           else{
               if(p<=0){
                   $(".ctrl .prev").addClass("disabled")
                   $(".ctrl .next").removeClass("disabled")
               }else if(p>=maxpage-1){
                   $(".ctrl .prev").removeClass("disabled")
                   $(".ctrl .next").addClass("disabled")
               }else{
                   $(".ctrl .prev").removeClass("disabled")
                   $(".ctrl .next").removeClass("disabled")
               }
           }
           $(".ctrl a").removeClass("active")
           $(this).addClass("active")


           $.ajax({
               url:"ajax/selectAgent.php",
               data:{
                   pagenum:p,
                   aid:aid,
                   sid:sid
               },
               success:chuli2
           })//初始化ajax


       })





    }


//无需更新下面的页码列表
      function chuli2(d){
          console.dir(d)
          var listr='';

          //d.data[0].aid
          //d.data[0].sid
          for(var i=0;i< d.data.length;i++){
              listr+='<li> ' +
              '<div class="pic"> ' +
              '<a href="agentdetail.html?id='+d.data[i].id+'"> ' +
              '<img src="ajax/upload/'+d.data[i].src+'" alt=""/> ' +
              '</a> ' +
              '</div> ' +
              '<div class="mid"> ' +
              '<h1>'+ d.data[i].agentName+'</h1> ' +
              '<p>主营板块：<span>'+ d.data[i].area+'</span>    <span>'+ d.data[i].street+'</span> </p> ' +
              '<div class="phone">'+d.data[i].agentPhone+' ' +
              '</div> ' +
              '</div> ' +
              '<div class="btn"> ' +
              '<a href="agentdetail.html?id='+d.data[i].id+'">进入TA的店铺</a> ' +
              '</div> ' +
              '</li>';

          }

          $("ul.list").html(listr)


      }



  })//网页加载完成
})()