<?php
 include 'D:/Workspace/PHP/blog/config/auth.php'; // 包含配置文件
 session_start(); // 使用session存储登陆的用户信息
 if(isset($_POST['user']) && isset($_POST['passwd'])){ // 判断用户的输入
 	$user = $_POST['user'];
 	$passwd = $_POST['passwd'];
 	
 	$passwd = md5($passwd); // 对密码使用md5加密
 	if($user != $AUTH['user'] || $passwd != $AUTH['passwd']){ 
 		echo '<strong><font color = "red">用户名或密码错误！</font></strong>';
 	}else{
//  		echo "success"; 
 		$_SESSION['user'] = $user;  
   		header('location:index.php'); 
 		
 	}
 }
 ?>
 <!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>基于文本的简易blog</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<div id="container"></div>
<div id="header">
    <h1>我的BLOG</h1>
</div>
<div id="title">
    --- I have a dream ---
</div>
<div id="content">
    <div id="left">
        <div id="blog_entry">
            <div id="blog_title">用户登录</div>
            <div id="blog_body">
                <form action="login.php" method="post" name="form">
                    <table>
                        <tr><td>用户名称 ：</td></tr>
                        <tr><td><input type="text" size="15" name="user"/></td></tr>
                        <tr><td>用户密码 ：</td></tr>
                        <tr><td><input type="password" size="15" name="passwd"/></td></tr>
                        <tr><td><input type="submit" name="Submit" value="登陆"/></td></tr>
                    </table>
                </form>
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
</body>
</html>
