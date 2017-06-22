<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:告诉前端给第n个版面的所有用户
* @param   pagenum
* return {status:"OK",data:[{id:"df",nike:"df",phone:"132",pwd:"132"},{id:"df",nike:"df",phone:"132",pwd:"132"}]}
*/
/*参数获取*/
@$a=$_REQUEST["pagenum"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tuser order by ID ASC limit ".($a*6).",6";//cmd
$res=mysqli_query($con,$sql);
//var_dump($res);
$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
$i++;
 if($i==1){
	 $str.="{\"id\":".$row["ID"].",\"phone\":\"".$row["Cphone"]."\",\"pwd\":\"".$row["Cpwd"]."\",\"nike\":\"".$row["Cnike"]."\"}";
	 }
 else{
	 $str.=",{\"id\":".$row["ID"].",\"phone\":\"".$row["Cphone"]."\",\"pwd\":\"".$row["Cpwd"]."\",\"nike\":\"".$row["Cnike"]."\"}";
	 }	 	 
	 }
 $str.="]}"; 
 echo $str;	 
/*$row=mysqli_fetch_array($res);
echo $row["Cdate"];
$row=mysqli_fetch_array($res);
echo $row["Cdate"];
$row=mysqli_fetch_array($res);
echo $row["Cdate"];*/
mysqli_free_result($res);
mysqli_close($con);
//echo $a;
?>