<?php
//header
//接收
$a=$_REQUEST["user"];
$b=$_REQUEST["phone"];
//时区回来
date_default_timezone_set("Asia/Shanghai");
var_dump($_FILES["wen"]);
//$c=$_FILES["wen"]["name"];//得到的信息比更多，得到临时文件名
$zz="";// time() 43534345.jpg 字符串的加密算法 sha1
$tmp1=explode(" ",microtime());
$tmp2=($tmp1[1]+$tmp1[0])*10000 . rand(0,10000);
if($_FILES["wen"]["type"]=="image/jpeg"){
	$zz="upload/".md5($tmp2).".jpg";
	}
elseif($_FILES["wen"]["type"]=="image/png"){
	$zz="upload/".md5($tmp2).".png";
	}
elseif($_FILES["wen"]["type"]=="image/gif"){
	$zz="upload/".md5($tmp2).".gif";
	}
else{
	$zz="tmp";
	}
move_uploaded_file($_FILES["wen"]["tmp_name"],$zz);
// mysqli
echo $a;
echo $b;
//echo $c;
//echo $c;
?>