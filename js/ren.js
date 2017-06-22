/**
 * Created by bjwsl-001 on 2017/5/11.
 */
(function(){
  $(function(){
      //头尾生成
     $(".header").load("header.html",function(){
        $(".header .nav a").removeClass("active").eq(3).addClass("active")
     })
     $(".footer").load("footer.html")
     //加载中间区域// html location.search ?id=45645
      var p=parseInt(location.search.substring(4))
      if(isNaN(p)){ p=1 }
      $.ajax({
          url:"ajax/selectOneNews.php",
          data:{ id:p } ,
          success : chuli
      });
      function chuli(d){
          console.dir(d)
         // console.dir(d.data[0].title)
         // console.dir(d.data[0].date)
         // console.dir(d.data[0].cnt)
          $(".container .title span").html(d.data[0].title);
          $(".container .newstitle h1").html(d.data[0].title);
          var k=d.data[0].date;//2014-02-03 12:00:00
          $(".container .newstitle p").html("发布日期 : "+k.substring(0,10));
          $(".container .newscnt").html(d.data[0].cnt);

      }

  })//网页加载完成
})()