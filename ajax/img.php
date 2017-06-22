<?PHP
//header("Content-Type:image/png");
$b=0.5;
$src=imagecreatefrompng("1.png");
$arr=getimagesize("1.png");
$dst=imagecreatetruecolor($arr[0]*$b,$arr[1]*$b);
var_dump($arr);
imagecopyresampled($dst,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
//内存级别大小调整
//输出1 显示器 2 硬盘
//imagepng($dst);
imagepng($dst,"2.png");
//销毁
imagedestroy($dst);

$b=0.25;
$dst1=imagecreatetruecolor($arr[0]*$b,$arr[1]*$b);
var_dump($arr);
imagecopyresampled($dst1,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
//内存级别大小调整
//输出1 显示器 2 硬盘
//imagepng($dst);
imagepng($dst1,"3.png");
//销毁
imagedestroy($dst1);


//function resizePng($src,$dst,$b);
  function resizePng($from,$to,$b){
$src=imagecreatefrompng($from);
$arr=getimagesize($from);
$dst=imagecreatetruecolor($arr[0]*$b,$arr[1]*$b);
imagecopyresampled($dst,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
imagepng($dst,$to);
imagedestroy($dst);//摧毁
	 }

function resizeJpeg($from,$to,$b){
$src=imagecreatefromjpeg($from);
$arr=getimagesize($from);
$dst=imagecreatetruecolor($arr[0]*$b,$arr[1]*$b);
imagecopyresampled($dst,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
imagejpeg($dst,$to);
imagedestroy($dst);//摧毁
	}
function resizeGif($from,$to,$b){
	$src=imagecreatefromgif($from);
$arr=getimagesize($from);
$dst=imagecreatetruecolor($arr[0]*$b,$arr[1]*$b);
imagecopyresampled($dst,$src,0,0,0,0,$arr[0]*$b,$arr[1]*$b,$arr[0],$arr[1]);
imagegif($dst,$to);
imagedestroy($dst);//摧毁
	}

function resizeImg($from,$to,$b){
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