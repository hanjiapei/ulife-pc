<?PHP
header("Content-Type:application/json;charset=UTF-8");
/*
*  输入部分
*  功能是:插入区域
*  参数是:@param  area
*  返回值:{"status":"OK","data":{"areaID":1,"areaName":"东城"}}
*  {"status":"FAIL","data":{"erromsg":1001}}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/
@$a=$_REQUEST["area"];//不像js
//功能
  $con=mysqli_connect("localhost","root","","ulift",3306);
  mysqli_query($con,"SET NAMES UTF8"); 
/*业务逻辑*/
  $sql="insert into Tarea (CaName) values ('".$a."')";
  mysqli_query($con,$sql);// 测试
  $r=mysqli_affected_rows($con);  
  $id=mysqli_insert_id($con);
  mysqli_close($con);//关闭数据库
//输出部分  
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"areaID\":".$id.",\"areaName\":\"".$a."\"}}";
	  }
  else{
	  echo "{\"status\":\"FALSE\",\"data\":{\"errorCode\":\"1001\"}}";
	  }
?>