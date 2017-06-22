<?PHP
header("Content-Type:application/json;charset=UTF-8");
/*
*  功能是:插入用户数据
*  参数是:@param  phone
*        @param  nick
*        @param  pwd
*  返回值:{"status":"OK","data":{"userID":30,"nikeName":"小","phone":"1232"}}
*        {status:"FAIL"}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/
@$a=$_REQUEST["phone"];//不像js
@$b=$_REQUEST["nike"];
@$c=$_REQUEST["pwd"];
//功能
  $con=mysqli_connect("localhost","root","","ulift",3306);
  mysqli_query($con,"SET NAMES UTF8"); 
/*业务逻辑*/
  $sql="insert into Tuser (Cphone,Cnike,Cpwd) values ('".$a."','".$b."','".$c."')";
  mysqli_query($con,$sql);// 测试
  $r=mysqli_affected_rows($con);  
  $id=mysqli_insert_id($con);
  mysqli_close($con);//关闭数据库
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"userID\":".$id.",\"userPhone\":\"".$a."\",\"userNike\":\"".$b."\"}}";
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