<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
 <pre>
 <?php
     $a="ab\ncd";
	 echo $a;
	/* $b=str_replace(array("\r\n","\r","\n"),'*',$a);
	 echo $b;*/
	 $b=str_replace(PHP_EOL,'*',$a);
	 echo $b;
 ?>
 </pre>
</body>
</html>