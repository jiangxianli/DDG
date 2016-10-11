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

    <link href="//cdn.bootcss.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>

    <style>
        body{
            width:500pt;
            margin: 0 auto;
            font-family: '宋体';
            word-wrap: break-word;
            word-break: normal;
        }
        p{

        }
    </style>

    <style>

    </style>
</head>
<body>
<p>
    <br/>
</p>
<div class="Section0">
    <p class="MsoNormal">
        <div class="Section0">
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span
                style="font-size:26.0000pt;">&nbsp;</span><span
                style="font-size:26.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:26.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:26.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:26.0000pt;"></span>
    </p>
    <p class="MsoNormal" align="center" style="margin-left:0.0000pt;text-indent:0.0000pt;text-align:center;">
        <span style="font-size:26.0000pt;"><span>商品管理平台数据字典</span></span><span
                style="font-size:26.0000pt;">V1.0</span><span
                style="font-size:26.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal" align="right" style="text-align:right;">
        <span style="font-size:12.0000pt;"></span>
    </p>
    <p class="MsoNormal">
        <span style="font-size:12.0000pt;"></span>
    </p>
</div>
<span style="font-weight:bold;font-size:20.0000pt;"><br/>
</span>
<h1>
    <span style="font-size:20pt;">I&nbsp;</span><b><span style="font-size:20pt;"><span>实体目录</span></span></b><b><span
                style="font-size:20pt;"></span></b>
</h1>
<p class="MsoNormal">
    <span style="font-size:5.0000pt;"></span>
</p>
<table class="MsoNormalTable" style="border-collapse:collapse;width:493.2000pt;">
    <tbody>
    <tr>
        <td width="228" valign="top" style="border:1.0000pt solid windowtext;">
            <p class="MsoNormal">
                <span style="font-size:12.0000pt;">Code</span><span
                        style="font-size:12.0000pt;"></span>
            </p>
        </td>
        <td width="171" valign="top" style="border:1.0000pt solid windowtext;">
            <p class="MsoNormal">
                <span style="font-size:12.0000pt;">Name</span><span
                        style="font-size:12.0000pt;"></span>
            </p>
        </td>
        <td width="258" valign="top" style="border:1.0000pt solid windowtext;">
            <p class="MsoNormal">
                <span style="font-size:12.0000pt;">Comment</span><span
                        style="font-size:12.0000pt;"></span>
            </p>
        </td>
    </tr>
    @foreach($rows as $row)
        <tr>
            <td width="228" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">{{ $row['table_code'] }}</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
            <td width="171" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">{{ $row['table_name'] }}</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
            <td width="258" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">{{ $row['table_comment'] }}</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<p class="MsoNormal">
    <span style="font-size:10.0000pt;"></span>
</p>
<h1>
    <span style="font-size:20pt;">II&nbsp;</span><b><span
                style="font-size:20pt;"><span>实体清单</span></span></b><b><span
                style="font-size:20pt;"></span></b>
</h1>
@foreach($rows as $key => $row)
    <h2>
        <span style="font-size:16pt;">II.{{ $key+1 }}&nbsp;</span><b>
            <span style="font-size:16pt;">{{ $row['table_code'] }}</span></b><b><span
                    style="font-size:16pt;">(</span></b><b><span
                    style="font-size:16pt;"><span>{{ $row['table_name'] }}</span></span></b><b><span
                    style="font-size:16pt;">)</span></b><b><span
                    style="font-size:16pt;"></span></b>
    </h2>
    <h3>
        <span style="font-style:italic;font-size:14.0000pt;">II.{{ $key+1 }}.1&nbsp;</span><i><span
                    style="font-size:14pt;"><span>实体结构</span></span></i><i><span
                    style="font-size:14pt;"></span></i>
    </h3>
    <table class="MsoNormalTable" style="border-collapse:collapse;width:496.3500pt;">
        <tbody>
        <tr>
            <td width="105" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">字段</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
            <td width="105" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">名称</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
            <td width="100" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">数据类型</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
            <td width="81" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">默认值</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
            <td width="215" valign="top" style="border:1.0000pt solid windowtext;">
                <p class="MsoNormal">
                    <span style="font-size:12.0000pt;">注释说明</span><span
                            style="font-size:12.0000pt;"></span>
                </p>
            </td>
        </tr>
        @foreach($row['columns'] as $column)
            <tr>
                <td width="105" valign="top" style="border:1.0000pt solid windowtext;">
                    <p class="MsoNormal" style="width:105px;">
                        {{ $column['column_code'] }}
                    </p>
                </td>
                <td width="105" valign="top" style="border:1.0000pt solid windowtext;">
                    <p class="MsoNormal" style="width:105px;">
                        {{  $column['column_name'] }}
                    </p>
                </td>
                <td width="100" valign="top" style="border:1.0000pt solid windowtext;">
                    <p class="MsoNormal" style="width:100px;">
                        {{ $column['type'] }}
                    </p>
                </td>
                <td width="81" valign="top" style="border:1.0000pt solid windowtext;">
                    <p class="MsoNormal" style="width:81px;">
                        <span style="font-size:12.0000pt;">{{ $column['default'] }}</span>
                    </p>
                </td>
                <td width="215" valign="top" style="border:1.0000pt solid windowtext;">
                    <p class="MsoNormal">
                        {{ $column['column_comment'] }}
                    </p>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endforeach

</body>
</html>
