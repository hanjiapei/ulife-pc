<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:告诉前端给第n个版面的所有经纪人
* @param   pagenum
* return {status:"OK",data:[{title:"df",cnt:"df",date:"2012-02-02 12:00:00",src:"dfdfdsf.jpg"},{title:"df",cnt:"df"},{title:"df",cnt:"df"}]}
*/
/*参数获取*/
@$a=$_REQUEST["pagenum"];
@$b=$_REQUEST["aid"];
@$c=$_REQUEST["sid"];
/*数据库*/
$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select A.ID,A.Cname,A.Cphone,A.Csrc,A.CAID,A.CSID,B.Caname,C.Csname from tagent as A,tarea as B,tstreet as C where A.CAID=B.ID and A.CSID=C.ID " ;
if(!($b==NULL||$b=="")){
	$sql.=" and A.CAID = ".$b." ";
	}
if(!($c==NULL||$c=="")){
	$sql.=" and A.CSID = ".$c." ";
	}
//无分页影响行数
$res2=mysqli_query($con,$sql);	
$r=mysqli_affected_rows($con);	

//分页拼接	
$sql.=" order by A.ID DESC limit ".($a*6).",6";


//echo $sql;

$res=mysqli_query($con,$sql);
//var_dump($res);
$str="{\"status\":\"OK\",\"total\":".$r.",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
$i++;
 if($i!=1){
	 $str.=",";
	 }

	 $str.="{\"id\":".$row["ID"].",\"agentName\":\"".$row["Cname"]."\",\"agentPhone\":\"".$row["Cphone"]."\",\"src\":\"".$row["Csrc"]."\",\"area\":\"".$row["Caname"]."\",\"street\":\"".$row["Csname"]."\",\"aid\":".$row["CAID"].",\"sid\":".$row["CSID"]."}";
	 
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