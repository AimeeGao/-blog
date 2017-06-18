<?php
session_start();
$ok = false;

if(empty($_SESSION['user']) || $_SESSION['user'] != 'aim'){ // 判断用户是否登陆
	echo '请<a href="login.php">登陆</a>后执行该操作。';
	exit;
}
if(!isset($_GET['entry']))   
{
	if(!isset($_POST['id'])){
		$ok = true;
		$msg = '请求参数错误！<a href="index.php">返回首页</a>';
	}
	else
	{
		// 做删除操作
		$path = substr($_POST['id'], 0,6); 
		$entry = substr($_POST['id'], 7,9); 
		$file_name = "D:/Workspace/PHP/blog/content/".$path.'/'.$entry.'.txt';
		if(unlink($file_name)){ 
			$ok = true;
			$msg = '该日志成功删除！<a href="index.php">返回首页</a>';
		}
		else{
				$ok = true;
				$msg = '该日志删除失败！<a href="index.php">返回首页</a>';
			
		}
	}
}
else{
	$form_data='';
	$path = substr($_GET['entry'], 0,6); 
	$entry = substr($_GET['entry'], 7,9);
	$file_name = 'D:/Workspace/PHP/blog/content/'.$path.'/'.$entry.'.txt';
	if(file_exists($file_name)){ 
		$form_data = '<input type="hidden" name="id" value="'.$_GET['entry'].'"/>';
	}
	else{
		$ok = true;
		$msg = '所要删除的日志不存在！<a href="index.php">返回首页</a>';
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
				<div id="blog_entry">
					<div id="blog_title">删除日志</div>
					<div id="blog_body">
						<?php 
							if($ok == false)
							{
						?>
						<form action="delete.php" method="POST">
							<font color="red">删除的日志将无法恢复，确定要删除吗？</font><br/>
							<input type="submit" value="确定"/> 
							<?php echo $form_data; ?>
						</form>
						<?php 
							}
						?>
						<?php 
						if($ok == true){
							echo $msg;
						}
						?>
					</div>
				</div>
			</div>
			<div id="right">
				<div id="sidebar">
					<div id="menu_title">关于我</div>
					<div id="menu_body">我是个PHP爱好者</div>
				</div>
			</div>
		</div>
		<div id="footer">CopyRight 2011-2017</div>
	</div>
</body>
</html>
