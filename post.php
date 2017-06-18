<?php
// 处理由URL传入的字符串参数
if(!isset($_GET['entry'])){
	echo '请求参数错误';
	exit;
}
$path = substr($_GET['entry'], 0,6); // 获取日志的存储目录
$entry = substr($_GET['entry'], 7,9); // 获取日志的文件名
$file_name = 'D:/workspace/PHP/blog/content/'.$path.'/'.$entry.'.txt'; 
if(file_exists($file_name)){ 
	$fp = fopen($file_name, 'r'); 
	if($fp){ // 如果文件存在
		flock($fp, LOCK_SH); 
		$result = fread($fp, 1024); 
	}
	flock($fp, LOCK_UN); 
	fclose($fp);
}
$content_array = explode("|", $result); 
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>基于文本的BLOG</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<div id="container">
    <div id="header">
        <h1>我的BLOG</h1>
    </div>
</div>
<div id="title">
    ---- I have a dream ----
</div>
<div id="content">
    <div id="left">
        <div id="blog_entry">
            <div id="blog_title">
                日志标题：<?php echo $content_array[0]?>
            </div>
            <div id="blog_body">
            <div id="blog_date">发布时间：<?php echo date('Y-m-d H:i:s',$content_array[1]); ?>  </div>
                <form action="add.php" method="post" name="form">
                    <table>
				<div><?php echo '日志内容：'.$content_array[2];?></div>
				<br/>
				<?php echo '<a href="index.php">返回首页</a>';?>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div id="right">
        <div id="sidebar">
            <div id="menu_title">关于我</div>
            <div id="menu_body">我是个php爱好者</div>
        </div>
    </div>
</div>
<div id="footer">
    CopyRight 2011-2017
</div>
</body>
</html>
