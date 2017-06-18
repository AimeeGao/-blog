<?php
session_start();
$info = "";

if(isset($_SESSION['user'])){ // 判断用户是否登陆
	$_SESSION['user'] = '';
	$msg = '您已经成功退出，<a href="index.php">返回首页</a>';
}
else{
	$msg = '您未曾登陆或已经超时退出，<a href="index.php">返回首页</a>';
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
	---- I have a Dream ----
</div>
<div id="content">
	<div id="left">
		<div id="blog_entry">
			<div id="blog_title">退出登录</div>
			<div id="blog_body">
			<?php echo $msg;?>
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
<div id="footer">
	CopyRight 2011-2017
</div>
</div>
</body>
</html>
