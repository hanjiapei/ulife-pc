<?PHP
header("Content-Type:application/json;charset=UTF-8");
/*
*  功能是:删除一个经纪人
*  参数是:@param  id
*  返回值:{"status":"OK","data":{"agentID":30}}
*  {"status":"FAIL","data":{"erromsg":1001}}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/
@$a=$_REQUEST["id"];//不像js
//功能
  $con=mysqli_connect("localhost","root","","ulift",3306);
  mysqli_query($con,"SET NAMES UTF8"); 
/*业务逻辑*/
  $sql="delete from tagent where id = ".$a."";
  mysqli_query($con,$sql);// 测试
  $r=mysqli_affected_rows($con);  
  //$id=mysqli_insert_id($con);
  mysqli_close($con);//关闭数据库
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"agentID\":".$a."}}";
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