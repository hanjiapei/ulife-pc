<?PHP
header("Content-Type:application/json;charset=UTF-8");
/*
*  功能是:插入一条楼市资讯新闻 后台管理系统里面管理员登录后可以发布新闻
*  参数是:@param  title 新闻标题
         @param  desc  新闻副标题描述
*        @param  date  无需传参，通过php中的date函数创建  
*        @param  src   新闻的缩略小图
         @param  cnt   正文
*  返回值:{"status":"OK","data":{"newsID":30,"title":"小","date":"2012","desc":"你好"}}
*        {status:"FAIL"}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/
@$a=$_REQUEST["title"];//不像js
@$b=$_REQUEST["desc"];
@$c="";//日期
@$d="";//文件名缩略图
@$e=$_REQUEST["cnt"];//正文
date_default_timezone_set("Asia/Shanghai");
// $c创建过程
$c=date("Y-m-d H:i:s");//格式 2010-02-02 12:03:04
 //上传单个文件的过程
$d="";//文件操作 文件拷贝到服务器 
$tmp1=explode(" ",microtime());
$tmp2=($tmp1[1]+$tmp1[0])*10000 . rand(0,10000);
if($_FILES["src"]["type"]=="image/jpeg"){
	$d=md5($tmp2).".jpg";
	}
elseif($_FILES["src"]["type"]=="image/png"){
	$d=md5($tmp2).".png";
	}
elseif($_FILES["src"]["type"]=="image/gif"){
	$d=md5($tmp2).".gif";
	}
else{
	$d="erro";
	}	
move_uploaded_file($_FILES["src"]["tmp_name"],"upload/".$d);	
//上传结束
//功能 数据库数据的插入过程 
  $con=mysqli_connect("localhost","root","","ulift",3306);
  mysqli_query($con,"SET NAMES UTF8"); 
/*业务逻辑*/
  $sql="insert into Tnews (Ctitle,Cdesc,Cdate,Cthumb,Ccnt) values ('".$a."','".$b."','".$c."','".$d."','".$e."')";//插入指令合成
  mysqli_query($con,$sql);// 插入动作
  $r=mysqli_affected_rows($con); //影响行数 
  $id=mysqli_insert_id($con);//插入的id
  mysqli_close($con);//关闭数据库
  //结果json的合成
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"newsID\":".$id.",\"title\":\"".$a."\",\"desc\":\"".$b."\",\"date\":\"".$c."\",\"src\":".$d.",\"cnt\":".$e."}}";
	  }
  else{
	  echo "{\"status\":\"FALSE\",\"data\":{\"errorCode\":\"1001\"}}";
	  }
//echo $r;
/*输出*/
//echo $a;
//echo $b;
//echo $c;
?>