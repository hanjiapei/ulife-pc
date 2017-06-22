<?PHP
header("Content-Type:application/json;charset=utf-8");
/*
* 功能:告诉前端给第n个版面的所有房源列表
* @param   pagenum  第几页
           aid      区id
		   sid      街道id
		   pricemin 最低价格
		   pricemax 最高价格
		   areamin 最小面积
		   areamax 最大面积
		   type    房源类型 一室
		   mode    整租合租
		   
* return {status:"OK",data:[{id:"df",cnt:"df",date:"2012-02-02 12:00:00",src:"dfdfdsf.jpg"},{title:"df",cnt:"df"},{title:"df",cnt:"df"}]}
*/
/*参数获取*/
@$a=$_REQUEST["pagenum"];
@$b=$_REQUEST["aid"];
@$c=$_REQUEST["sid"];
@$d=$_REQUEST["pricemin"];
@$e=$_REQUEST["pricemax"];
@$f=$_REQUEST["areamin"];
@$g=$_REQUEST["areamax"];
@$h=$_REQUEST["type"];
@$q=$_REQUEST["mode"];
/*数据库*/

$con=mysqli_connect("localhost","root","","ulift","3306");
mysqli_query($con,"set names uft8");
$sql="select * from tren where 1=1 ";

if(!($b==NULL||$b=="")){
	$sql.=" and CAID = ".$b." ";
	}//区id
if(!($c==NULL||$c=="")){
	$sql.=" and CSID = ".$c." ";
	}//街道id
if(!($d==NULL||$d=="")){
	$sql.=" and Cprice >= ".$d." ";
	}//价格大于
if(!($e==NULL||$e=="")){
	$sql.=" and Cprice <= ".$e." ";
	}//价格小于
if(!($f==NULL||$f=="")){
	$sql.=" and Carea >= ".$f." ";
	}//面积大于
if(!($g==NULL||$g=="")){
	$sql.=" and Carea <= ".$g." ";
	}// 面积的小于
if(!($h==NULL||$h=="")){
	$sql.=" and Ctype = '".$h."' ";
	}//几室参数
if(!($q==NULL||$q=="")){
	$sql.=" and Cmode = '".$q."' ";
	}	//整租合租参数
		
$sql.=" order by Cdate DESC limit ".($a*6).",6";//cmd
$res=mysqli_query($con,$sql);
//var_dump($res);
//echo $sql;
$str="{\"status\":\"OK\",\"data\":[";
$i=0;
 while($row=mysqli_fetch_array($res)){
$i++;
 if($i!=1){
	$str.=",";
	 }
	  $str.="{\"id\":".$row["ID"].",\"title\":\"".$row["Ctitle"]."\",\"src\":\"".$row["Cthumb"]."\",\"type\":\"".$row["Ctype"]."\"".
	 ",\"mode\":\"".$row["Cmode"]."\"".
	 ",\"area\":\"".$row["Carea"]."\"".
	 ",\"floor\":\"".$row["Cfloor"]."\"".
	 ",\"dir\":\"".$row["Cdir"]."\"".
	 ",\"add\":\"".$row["Cadd"]."\"".
	 ",\"price\":\"".$row["Cprice"]."\"".
	 ",\"date\":\"".$row["Cdate"]."\"".
	 ",\"pay\":\"".$row["Cpay"]."\"".
	 ",\"dec\":\"".$row["Cdec"]."\"".
	 ",\"desc\":\"".$row["Cdesc"]."\"".
	 ",\"aid\":\"".$row["CAID"]."\"".
	 ",\"sid\":\"".$row["CSID"]."\"".
	 "}";
	 
	 	 	 
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