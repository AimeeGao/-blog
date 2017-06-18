<?php
$login = false;
session_start();
if(empty($_SESSION['user']) && $_SESSION['user'] != 'aim'){
	$file_array = array();
	$folder_array = array();
	
	$dir = 'D:/Workspace/PHP/blog/content';
	$dh = opendir($dir);
	if($dh){
		$filename = readdir($dh);
		while ($filename){
			if($filename != '.' && $filename !='..'){
				$folder_name = $filename;
				array_push($folder_array, $folder_name);
			}
			$filename = readdir($dh);
		}
	}
	rsort($folder_array);
	$post_data = array();
	foreach ($folder_array as $folder){
		$dh = opendir($dir.'/'.$folder);
		while (($filename = readdir($dh)) !== false){
			if(is_file($dir.'/'.$folder.'/'.$filename)){
				$file = $filename;
				$file_name = $dir.'/'.$folder.'/'.$file;
				if(file_exists($file_name))
				{
					$fp = @fopen($file_name, 'r');
					if($fp)
					{
						flock($fp, LOCK_SH);
						$result = fread($fp,filesize($file_name));
					}
					flock($fp, LOCK_UN);
					fclose($fp);
				}
				$content_array = explode('|', $result);
				$temp_data = array();
				$temp_data['SUBJECT'] = $content_array[0];
				$temp_data['DATE'] = date('Y-m-d H:i:s',$content_array[1]);
				$temp_data['CONTENT'] = $content_array[2];
				$file = substr($file, 0,9);
				$temp_data['FILENAME'] = $folder.'-'.$file;
				array_push($post_data, $temp_data);
			}
			
		}
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
		<h1>我的BLOG</h1>
	</div>
	<div id="title">
		---- i have a dream ----
	</div>
	<div id="content">
		<div id="left">
		<?php foreach ($post_data as $post)
		{
		?>
			<div id="blog_entry">
				<div id="blog_title"><?php echo $post['SUBJECT'];?></div>
				<div id="blog_body">
				<div id="blog_date"><?php echo $post['DATE'];?></div>
				<?php echo $post['CONTENT'];?>
				</div>
			</div>
		<?php }?>
		</div>
		<div id="right">
			<div id="sidebar">
				<div id="menu_title">关于我</div>
				<div id="menu_body">
				我是个PHP爱好者
				<br/>
				<?php echo '<a href="login.php">登录</a>'?>
				</div>
				
			</div>
			<br/><br/>
			<div id="sidebar">
				<div id="menu_title">日志归档</div>
				<?php 
					foreach ($folder_array as $ym){
						$entry = $ym;
						$ym = substr($ym, 0,4).'-'.substr($ym, 4,2);
						echo '<div id="menu_body"><a href="archives.php?ym='.$entry.'">'.$ym.'</a></div>';
					}
				?>
			</div>
		</div>
		<div id="footer">
			CopyRight 2011-2017
		</div>
	</div>
</div>
</body>
</html>
