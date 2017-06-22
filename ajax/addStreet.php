<?PHP
header("Content-Type:application/json;charset=UTF-8");
/*
*  功能是:插入街道数据
*  参数是:@param  aid
         @param  street
*  返回值:{"status":"OK","data":{"streetID":30,"streetName":"小","CID":1}}
*  {"status":"FAIL","data":{"erromsg":1001}}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/
@$a=$_REQUEST["aid"];//不像js
@$b=$_REQUEST["street"];
//功能
  $con=mysqli_connect("localhost","root","","ulift",3306);
  mysqli_query($con,"SET NAMES UTF8"); 
/*业务逻辑*/
  $sql="insert into Tstreet (CID,CsName) values ('".$a."','".$b."')";
  mysqli_query($con,$sql);// 测试
  $r=mysqli_affected_rows($con);  
  $id=mysqli_insert_id($con);
  mysqli_close($con);//关闭数据库
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"streetID\":".$id.",\"CID\":\"".$a."\",\"streetName\":\"".$b."\"}}";
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