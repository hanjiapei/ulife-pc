<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:根据id返回一用户信息
* @param   id
* return {status:"OK",data:[{userID:"df",nike:"df",pwd:"12345",phone:"12345"}]}
*/
/*参数获取*/
@$a=$_REQUEST["id"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tuser where ID = ".$a."";//cmd
$res=mysqli_query($con,$sql);
//var_dump($res);
$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
  $i++;
 if($i!=1){
	$str.=",";
	 }
 $str.="{\"id\":".$row["ID"].",\"nike\":\"".$row["Cnike"]."\",\"phone\":\"".$row["Cphone"]."\",\"pwd\":\"".$row["Cpwd"]."\"}";	 
	 	 	 
	 }
 $str.="]}"; 
 echo $str;	 
mysqli_free_result($res);
mysqli_close($con);
?>