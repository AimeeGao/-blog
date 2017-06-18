基于文本的简易BLOG
-----
## 该blog通过处理由URL传入的字符串参数，来实现基本的功能。 并且该博客是一个基于个人的单用户版Web程序。

### Blog系统的基本功能包含如下部分：
* 显示日志内容
* 发布日志
* 管理日志（删除、编辑日志）
* 用户登录与退出
* 日志归档显示

### 数据的存储及系统架构
    该博客采用将数据存储在普通文本文件中，实现数据库的功能。<br/>
    存储的数据主要包含三个部分：<br/>
    * 日志文章标题<br/>
    * 日志发布时间<br/>
    * 日志内容<br/>

