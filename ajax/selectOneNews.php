<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:根据id返回一条新闻的详情
* @param   id
* return {status:"OK",data:[{title:"df",cnt:"df",date:"2012-02-02 12:00:00",src:"dfdfdsf.jpg"}]}
*/
/*参数获取*/
@$a=$_REQUEST["id"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tnews where ID = ".$a."";//cmd
$res=mysqli_query($con,$sql);
//var_dump($res);
$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
  $i++;
  $chg=str_replace(array("\r\n","\r","\n"),'',$row[5]);
 if($i==1){
	 $str.="{\"id\":".$row[0].",\"title\":\"".$row[1]."\",\"desc\":\"".$row[2]."\",\"date\":\"".$row[3]."\",\"src\":\"".$row[4]."\",\"cnt\":\"".$chg."\"}";
	 }
 else{
	 $str.=",{\"id\":".$row[0].",\"title\":\"".$row[1]."\",\"desc\":\"".$row[2]."\",\"date\":\"".$row[3]."\",\"src\":\"".$row[4]."\",\"cnt\":\"".$chg."\"}";
	 }	 	 
	 }
 $str.="]}"; 
 echo $str;	 
mysqli_free_result($res);
mysqli_close($con);
?>