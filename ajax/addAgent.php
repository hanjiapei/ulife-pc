<?PHP
/*header("Content-Type:application/json;charset=UTF-8");
$con=mysqli_connect("localhost","root","","ulift",3306);
mysqli_query($con,"SET NAMES UTF8"); */

// php 引用comm.php  require_once(); require();
require("comm.php");

/*
*  功能是:插入中介信息
*  参数是:@param  name
         @param  phone
*        @param  src
*        @param  cid
         @param  sid
*  返回值:{"status":"OK","data":{"userID":30,"name":"小","phone":"1232","src":"909.jpg","cid":1,"sid":2}}
*        {status:"FAIL"}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/
@$a=$_REQUEST["name"];//不像js
@$b=$_REQUEST["phone"];
//@$c=$_REQUEST["src"];
@$d=$_REQUEST["cid"];
@$e=$_REQUEST["sid"];
$c="";//文件操作 文件拷贝到服务器 
date_default_timezone_set("Asia/Shanghai");
$tmp1=explode(" ",microtime());
$tmp2=($tmp1[1]+$tmp1[0])*10000 . rand(0,10000);
if($_FILES["src"]["type"]=="image/jpeg"){
	$c=md5($tmp2).".jpg";
	}
elseif($_FILES["src"]["type"]=="image/png"){
	$c=md5($tmp2).".png";
	}
elseif($_FILES["src"]["type"]=="image/gif"){
	$c=md5($tmp2).".gif";
	}
else{
	$c="erro";
	}	
move_uploaded_file($_FILES["src"]["tmp_name"],"upload/".$c);	

//功能
  /*$con=mysqli_connect("localhost","root","","ulift",3306);
  mysqli_query($con,"SET NAMES UTF8"); */
/*业务逻辑*/
  $sql="insert into TAgent (Cname,Cphone,Csrc,CAID,CSID) values ('".$a."','".$b."','".$c."',".$d.",".$e.")";//insert ('df','df',90)
  mysqli_query($con,$sql);// 测试
  $r=mysqli_affected_rows($con);  
  $id=mysqli_insert_id($con);
  mysqli_close($con);//关闭数据库
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"agentID\":".$id.",\"agentName\":\"".$a."\",\"userPhone\":\"".$b."\",\"src\":\"".$c."\",\"CAID\":".$d.",\"CSID\":".$e."}}";
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