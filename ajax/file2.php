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

var_dump($_FILES["wen2"]);

$ZZ2="";
$tmp12=explode(" ",microtime());
$tmp22=($tmp12[1]+$tmp12[0])*10000 . rand(0,10000);
if($_FILES["wen2"]["type"]=="image/jpeg"){
	$ZZ2="upload/".md5($tmp22).".jpg";
	}
elseif($_FILES["wen2"]["type"]=="image/png"){
	$ZZ2="upload/".md5($tmp22).".png";
	}
elseif($_FILES["wen2"]["type"]=="image/gif"){
	$ZZ2="upload/".md5($tmp22).".gif";
	}
else{
	$ZZ2="tmp22";
	}
move_uploaded_file($_FILES["wen2"]["tmp_name"],$ZZ2);




$ZZ3="";
$tmp13=explode(" ",microtime());
$tmp23=($tmp13[1]+$tmp13[0])*10000 . rand(0,10000);
if($_FILES["wen2"]["type"]=="image/jpeg"){
	$ZZ3="upload/".md5($tmp23).".jpg";
	}
elseif($_FILES["wen2"]["type"]=="image/png"){
	$ZZ3="upload/".md5($tmp23).".png";
	}
elseif($_FILES["wen2"]["type"]=="image/gif"){
	$ZZ3="upload/".md5($tmp23).".gif";
	}
else{
	$zz="tmp23";
	}
move_uploaded_file($_FILES["wen3"]["tmp_name"],$ZZ3);


$ZZ4="";

$tmp14=explode(" ",microtime());
$tmp24=($tmp14[1]+$tmp14[0])*10000 . rand(0,10000);
if($_FILES["wen4"]["type"]=="image/jpeg"){
	$ZZ4="upload/".md5($tmp24).".jpg";
	}
elseif($_FILES["wen4"]["type"]=="image/png"){
	$ZZ4="upload/".md5($tmp24).".png";
	}
elseif($_FILES["wen4"]["type"]=="image/gif"){
	$ZZ4="upload/".md5($tmp24).".gif";
	}
else{
	$zz4="tmp24";
	}
move_uploaded_file($_FILES["wen4"]["tmp_name"],$ZZ4);










// mysqli
echo $a;
echo $b;
//echo $c;
//echo $c;
?>