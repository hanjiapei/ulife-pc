<?PHP
header("Content-Type:application/json;charset=UTF-8");
/*
*  功能是:插入一条轮播图
*  参数是:@param  cid 连接到哪篇文章
*        @param  src   新闻的缩略小图
*  返回值:{"status":"OK","data":{"bannerID":30,"src":"小","cid":11}}
*        {status:"FAIL"}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/
@$a=$_REQUEST["cid"];//不像js
@$b="";//文件名缩略图
date_default_timezone_set("Asia/Shanghai");
// $c创建过程
//$c=date("Y-m-d H:i:s");//格式 2010-02-02 12:03:04
 //上传单个文件的过程
$b="";//文件操作 文件拷贝到服务器 
$tmp1=explode(" ",microtime());
$tmp2=($tmp1[1]+$tmp1[0])*10000 . rand(0,10000);
if($_FILES["src"]["type"]=="image/jpeg"){
	$b=md5($tmp2).".jpg";
	}
elseif($_FILES["src"]["type"]=="image/png"){
	$b=md5($tmp2).".png";
	}
elseif($_FILES["src"]["type"]=="image/gif"){
	$b=md5($tmp2).".gif";
	}
else{
	$b="erro";
	}	
move_uploaded_file($_FILES["src"]["tmp_name"],"upload/".$b);	
//上传结束
//功能 数据库数据的插入过程 
  $con=mysqli_connect("localhost","root","","ulift",3306);
  mysqli_query($con,"SET NAMES UTF8"); 
/*业务逻辑*/
  $sql="insert into Tbanner (CID,Csrc) values (".$a.",'".$b."')";//插入指令合成
  mysqli_query($con,$sql);// 插入动作
  $r=mysqli_affected_rows($con); //影响行数 
  $id=mysqli_insert_id($con);//插入的id
  mysqli_close($con);//关闭数据库
  //结果json的合成
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"bannerID\":".$id.",\"cid\":\"".$a."\",\"src\":\"".$b."\"}}";
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