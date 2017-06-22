<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
  *{ margin: 0;padding: 0;list-style-type: none;text-decoration: none;}
  header{ width:980px; height:120px; background-color: #ccc; margin:0 auto;}
  #main{ width: 980px;margin: 0 auto;}
  #main ul li{ height:100px; border-bottom:1px solid #ccc; padding-top:10px; padding-bottom:10px;}
</style>
</head>
<body>
   <header>df</header>
   <div id="main">
   <ul>
     <?PHP
       @$con=mysqli_connect("localhost","root","","ulift",3306);
	   mysqli_query($con,"set names UTF8");
	   $res=mysqli_query($con,"select * from tagent");
	   while($line=mysqli_fetch_array($res)){
		   echo "<li>名字".$line['ID']."照片</li>";
		   }
    ?>
   </ul>
   </div>
</body>
</html>