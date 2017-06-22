<?php
//header
//接收
$a=$_REQUEST["user"];
$b=$_REQUEST["phone"];
//时区回来
date_default_timezone_set("Asia/Shanghai");
//var_dump($_FILES["wen"]);
//$c=$_FILES["wen"]["name"];//得到的信息比更多，得到临时文件名
$zz="";// time() 43534345.jpg 字符串的加密算法 sha1
$zzmid="";
$zzsm="";
$tmp1=explode(" ",microtime());
$tmp2=($tmp1[1]+$tmp1[0])*10000 . rand(0,10000);
if($_FILES["wen"]["type"]=="image/jpeg"){
	$zz=md5($tmp2).".jpg";
	$zzmid=md5($tmp2)."mid.jpg";
	$zzsm=md5($tmp2)."small.jpg";
	}
elseif($_FILES["wen"]["type"]=="image/png"){
	$zz=md5($tmp2).".png";
	$zzmid=md5($tmp2)."mid.png";
	$zzsm=md5($tmp2)."small.png";
	}
elseif($_FILES["wen"]["type"]=="image/gif"){
	$zz=md5($tmp2).".gif";
	$zzmid=md5($tmp2)."mid.gif";
	$zzsm=md5($tmp2)."small.gif";
	}
else{
	$zz="tmp";
	$zzmid="mid";
	$zzsm="small";
	}
move_uploaded_file($_FILES["wen"]["tmp_name"],"upload/".$zz);

 resizeImg("upload/".$zz,"upload/".$zzmid,0.5);
 resizeImg("upload/".$zz,"upload/".$zzsm,0.25);
 
function resizeImg($from,$to,$b){
	echo "222";
	$arr=getimagesize($from);
	var_dump($arr);
	$dst=imagecreatetruecolor($arr[0]*$b,$arr[1]*$b);
	 if($arr["mime"]=="image/png"){
		 $src=imagecreatefrompng($from);
		 imagecopyresampled($dst,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
		 imagepng($dst,$to);
	 }elseif($arr["mime"=="image/jpeg"]){
		 $src=imagecreatefromjpeg($from);
		 imagecopyresampled($dst,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
		 imagejpeg($dst,$to);
	 }elseif($arr["mime"=="image/gif"]){
		 $src=imagecreatefromgif($from);
		 imagecopyresampled($dst,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
		 imagegif($dst,$to);
	 }
	 imagedestroy($dst);//摧毁
	}

// mysqli
//echo $a;
//echo $b;
//echo $c;
//echo $c;
?>