<?php
$ok = false;
if(!isset($_GET['ym']) || empty($_GET['ym'])){ //请求参数中的目录信息 
	$ok = true;
	$msg = '请求参数错误！<a href="index.php">返回首页</a>';
}

$folder_array = array(); // 归档目录后的所有目录存在此数组中
$dir = 'D:/Workspace/PHP/blog/content'; // 注意盘符的格式
$folder = $_GET['ym'];
if(!is_dir($dir.'/'.$folder)){ // 找到content目录下的所有归档目录
	$ok = true;
	$msg = '请求参数错误！<a href="index.php">返回首页</a>';
}

$dh = opendir($dir); // 打开目录
if($dh){
	$filename = readdir($dh); // 读取指定目录下的所有目录
	while($filename){
		if($filename != '.' && $filename != '..'){
			$folder_name = $filename;
			array_push($folder_array, $folder_name);
		}
		$filename = readdir($dh);
	}
}
rsort($folder_array); // 对目录进行排序
$post_data = array();
$dh = opendir($dir.'/'.$folder);
while (($filename = readdir($dh))!== FALSE){
	if(is_file($dir.'/'.$folder.'/'.$filename)){
		$file = $filename;
		$file_name = $dir.'/'.$folder.'/'.$file;
		if(file_exists($file_name)){
			$fp = @fopen($file_name, 'r');
			if($fp){
				flock($fp, LOCK_SH);
				$result = fread($fp, filesize($file_name)); // 读取文件
			}
			flock($fp, LOCK_UN);
			fclose($fp);
		}
		$temp_data = array();
		$content_array = explode('|', $result);
		// 以下是文件中的3个日志信息
		$temp_data['SUBJECT'] = $content_array[0]; // 读取标题
		$temp_data['DATE'] = date('Y-m-d H:i:s',$content_array[1]); // 读取日期
		$temp_data['CONTENT'] = $content_array[2]; // 读取内容
		array_push($post_data, $temp_data); 
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>基于文本的简易BLOG</title>
<link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
<div id="container">
<div id="header">
<h1>我的blog</h1>
</div>
<div id="title">
---- I Have a Dream ----
</div>
<div id="content">
	<div id="left">
	<?php 
		if($ok == false)
		{
			foreach ($post_data as $post)
			{	
	?>
		<div id="blog_entry">
			<div id="blog_title"><?php echo $post['SUBJECT'];?></div>
			<div id="blog_body">
				<div id="blog_date"><?php echo $post['DATE']; ?></div>
			<?php echo $post['CONTENT']; ?>
			</div>
		</div>
	<?php   
			} 
		}
	else{
		echo $msg;
	}
	?>
	</div>
	<div id="right">
		<div id="sidebar">
			<div id="menu_title">关于我</div>
			<div id="menu_body">我是个PHP爱好者
			<br/><br/>
			<a href="login.php">登陆</a>
			
			</div>
			
			
		</div>
		<br/>
		<div id="sidebar">
			<div id="menu_title">日志归档</div>
			<?php 
				foreach ($folder_array as $ym)
				{
					$entry = $ym;
					$ym = substr($ym, 0,4).'-'.substr($ym, 4,2);
					echo '<div id="menu_body"><a href="archives.php?ym='.$entry.'">'.$ym.'</a></div>';
				}
			?>
		</div>
	</div>
	<div id="footer">CopyRight 2011-2017</div>
	
	</div>
</div>

</body>
</html>
