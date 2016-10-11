<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <!--  width - viewport的宽度 height - viewport的高度 initial-scale - 初始的缩放比例 minimum-scale - 允许用户缩放到的最小比例 maximum-scale - 允许用户缩放到的最大比例 user-scalable - 用户是否可以手动缩放  -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- 禁用手机号码显示为拨号的超链接 -->
    <meta name="format-detection" content="telephone=no">
    <!-- 不识别邮箱 -->
    <meta content="email=no" name="format-detection"/>
    <!-- 开启对web app程序的支持 -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- 添加到主屏幕“后，全屏显示 -->
    <meta name="apple-touch-fullscreen" content="yes">

    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/lobibox.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/lobibox.js"></script>
    <script src="/js/app.js"></script>

</head>
<body>
    <div class="left-menu">
        <form role="form">
            <div class="form-group">
                <label for="exampleInputEmail1">Host</label>
                <input name="host" type="text" class="form-control"  placeholder="数据库连接主机地址">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">UserName</label>
                <input name="username" type="text" class="form-control" placeholder="数据库用户名">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" value="" placeholder="数据库密码">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">DataBase</label>
                <input name="database" type="text" class="form-control" placeholder="数据库名">
            </div>
            <button type="button" class="btn btn-default btn-generate">生成字典</button>
            <button type="button" class="btn btn-default btn-clear">清除字典</button>
        </form>
    </div>

    <div style="height: 100px;"></div>

    <div class="help">
        <div class="panel panel-default">
            <div class="panel-heading">Mysql数据库字典生成器使用说明</div>
            <div class="panel-body">
                <p>
                    1.数据库设计的表或字段注释说明需严格按照“字段名称(注释说明)”格式，如“用户昵称(微信用户昵称)”；这里使用的是“()”而不是“（）”。<br>
                </p>
                <p>
                    2.填写的数据库用户需拥有information_schema数据库读的权限。<br>
                </p>
                <p>
                    3.请填写你的数据库配置信息开始生成字典吧！<br>
                </p>
            </div>
        </div>
    </div>

   <div class="generator">

   </div>
</body>
</html>
