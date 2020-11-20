<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BMS</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
        content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css')}}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('admin/lib/layui/layui.jg')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js')}}"></script>

</head>

<body class="login-bg">

    <div class="login">
        <div class="message">Blog Management System</div>

@if (count($errors) > 0)
    <div class="alert alert-danger" style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div id="darkbannerwrap"></div>

        <form method="post" class="layui-form" action="/admin/signIn">
        {{ csrf_field()}}
            <input name="username" placeholder="username" type="text" lay-verify="required" class="layui-input" autocomplete="off">
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="password" type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" lay-verify="required" placeholder="code" type="text" class="layui-input" autocomplete="off"
                style="width:50%;display:inline-block">
            <img src="{{ url('admin/code')}}" alt="code" style="width:40%;height:50px;"
                onclick="this.src='{{ url('admin/code')}}?'+Math.random()">
            <hr class="hr15">
            <input value="Sign In" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20">
        </form>
    </div>

    <script>
        $(function () {
            layui.use('form', function () {
                var form = layui.form;
                // layer.msg('玩命卖萌中', function(){
                //   //关闭后的操作
                //   });
                //监听提交
                form.on('submit(login)', function (data) {
                    // alert(888)
                    layer.msg(JSON.stringify(data.field), function () {
                        location.href = 'index.html'
                    });
                    return false;
                });
            });
        })
    </script>


    <!-- 底部结束 -->
</body>

</html>