<?PHP
header("Content-Type:application/json;charset=UTF-8");
/*
*  功能是:插入一条房源信息
*  参数是:@param  title 标题
         @param  src  缩略图
*        @param  type 几室几厅
*        @param  mode 整合组
         @param  area 面积
		 @param  floor 楼层
		 @param  dir 朝向
		 @param  add 地址
		 @param  price 价格
		 @param  date 日期
		 @param  area 面积
		 @param  pay  押一付三
		 @param  dec 装修
		 @param  desc 描述
		 @param  cnt 内容
		 @param  aid 区域
		 @param  sid 街道 
		 @param  pics 详情图 
*  返回值:{"status":"OK","data":{"renID":30,"title":"小","src":"1232","type":"几室几厅","mode":"整租","area":56.7,}}
*        {status:"FAIL"}
*/
/*参数的获取过程 $_GET $_POST $_REQUEST*/


@$title=$_REQUEST["title"] or "";
$src="";
//@$src=$_REQUEST["src"] or "default.jpg";
@$type=$_REQUEST["type"];
@$mode=$_REQUEST["mode"];
@$area=$_REQUEST["area"];
@$floor=$_REQUEST["floor"];
@$dir=$_REQUEST["dir"];
@$add=$_REQUEST["add"];
@$price=$_REQUEST["price"];
$date="";
//@$date=$_REQUEST["date"];
@$pay=$_REQUEST["pay"];
@$dec=$_REQUEST["dec"];
@$desc=$_REQUEST["desc"];
@$cnt=$_REQUEST["cnt"];
@$aid=$_REQUEST["aid"];
@$sid=$_REQUEST["sid"];
 
date_default_timezone_set("Asia/Shanghai");
$date=date("Y-m-d H:i:s");

//单图 src 缩略图的拷贝和入库


$zz="";// time() 43534345.jpg 字符串的加密算法 sha1
$tmp1=explode(" ",microtime());
$tmp2=($tmp1[1]+$tmp1[0])*10000 . rand(0,10000);
if($_FILES["src"]["type"]=="image/jpeg"){
	$zz=md5($tmp2).".jpg";
	}
elseif($_FILES["src"]["type"]=="image/png"){
	$zz=md5($tmp2).".png";
	}
elseif($_FILES["src"]["type"]=="image/gif"){
	$zz=md5($tmp2).".gif";
	}
else{
	$zz="tmp";
	}
move_uploaded_file($_FILES["src"]["tmp_name"],"upload/".$zz);
 



//功能
  $con=mysqli_connect("localhost","root","","ulift",3306);
  
  mysqli_query($con,"SET NAMES UTF8"); 
/*业务逻辑*/
  $sql="insert INTO `tren` (`Ctitle`,`Cthumb`,`Ctype`, `Cmode`, `Carea`, `Cfloor`, `Cdir`, `Cadd`, `Cprice`, `Cdate`, `Cpay`, `Cdec`, `Cdesc`, `Ccnt`, `CAID`, `CSID`) VALUES ('".$title."','".$zz."', '".$type."', '".$mode."', ".$area.", '".$floor."', '".$dir."', '".$add."', ".$price.", '".$date."', '".$pay."', '".$dec."', '".$desc."', '".$cnt."', ".$aid.", ".$sid.")";//insert ('df','df',90)
  
 
  
  
  mysqli_query($con,$sql);// 测试
  $r=mysqli_affected_rows($con);  
  $id=mysqli_insert_id($con);
  //echo $id;
  

  // 上传多个文件  pics
  
for($i=0;$i<count($_FILES["pics"]["name"]);$i++){
	  $zz="";// time() 43534345.jpg 字符串的加密算法 sha1
      $zzmid="";
      $zzsm="";
	  
	  $tmp1=explode(" ",microtime());
      $tmp2=($tmp1[1]+$tmp1[0])*10000 . rand(0,10000);
	  //echo $_FILES["wen"]["type"][$i];
if($_FILES["pics"]["type"][$i]=="image/jpeg"){
	$zz=md5($tmp2).".jpg";
	$zzmid=md5($tmp2)."mid.jpg";
	$zzsm=md5($tmp2)."small.jpg";
	}
elseif($_FILES["pics"]["type"][$i]=="image/png"){
	$zz=md5($tmp2).".png";
	$zzmid=md5($tmp2)."mid.png";
	$zzsm=md5($tmp2)."small.png";
	}
elseif($_FILES["pics"]["type"][$i]=="image/gif"){
	$zz=md5($tmp2).".gif";
	$zzmid=md5($tmp2)."mid.gif";
	$zzsm=md5($tmp2)."small.gif";
	}
else{
	$zz="tmp";
	$zzmid="mid";
	$zzsm="small";
	}
move_uploaded_file($_FILES["pics"]["tmp_name"][$i],"upload/".$zz);
resizeImg("upload/".$zz,"upload/".$zzmid,0.5);
resizeImg("upload/".$zz,"upload/".$zzsm,0.088);
  
  //进表动作 $id  cid $zz  路径
   $sql2="insert trdetail (CID,Cbsrc,Cmsrc,Cssrc) values (".$id.",'".$zz."','".$zzmid."','".$zzsm."')";
   mysqli_query($con,$sql2);// 测试
   $r=mysqli_affected_rows($con); 
 }
  
  
  
  mysqli_close($con);//关闭数据库
  if($r>=1){
	  echo "{\"status\":\"OK\",\"data\":{\"renID\":".$id.",\"rentitle\":\"".$title."\",\"src\":\"".$src."\",\"type\":\"".$type."\",\"CAID\":".$aid.",\"CSID\":".$sid."}}";
	  }
  else{
	  echo "{\"status\":\"FALSE\",\"data\":{\"errorCode\":\"1001\"}}";
	  }
//echo $r;
/*输出*/
//echo $a;
//echo $b;
//echo $c;
//改变任意的图片大小到指定比例
function resizeImg($from,$to,$b){
	//echo "222";
	$arr=getimagesize($from);
	
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


?>