<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:根据id返回一条经纪人详情
* @param   id
* return {status:"OK",data:[{agentID:"df",agentName:"df",agentPhone:"2012-02-02 12:00:00",src:"dfdfdsf.jpg","aid":2,"sid":3}]}
*/
/*参数获取*/
@$a=$_REQUEST["id"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tagent where ID = ".$a."";//cmd
$res=mysqli_query($con,$sql);
//var_dump($res);
$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
  $i++;
  
 if($i==1){
	 $str.="{\"id\":".$row["ID"].",\"agentName\":\"".$row["Cname"]."\",\"agentPhone\":\"".$row["Cphone"]."\",\"src\":\"".$row["Csrc"]."\",\"aid\":".$row["CAID"].",\"sid\":".$row["CSID"]."}";
	 }
 else{
	 $str.=",{\"id\":".$row["ID"].",\"agentName\":\"".$row["Cname"]."\",\"agentPhone\":\"".$row["Cphone"]."\",\"src\":\"".$row["Csrc"]."\",\"aid\":".$row["CAID"].",\"sid\":".$row["CSID"]."}";
	 }	 	 
	 }
 $str.="]}"; 
 echo $str;	 
mysqli_free_result($res);
mysqli_close($con);
?>