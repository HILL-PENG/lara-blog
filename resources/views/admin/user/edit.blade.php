<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.public.style')
    @include('admin.public.script')
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="x-body">
        <form class="layui-form">
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>email
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_email" name="email" required="" lay-verify="email" value="{{$user->email}}"
                    autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>username
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="username" lay-verify="username" value="{{$user->username}}" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>password
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_pass" name="password" lay-verify="password" autocomplete="off"
                        class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    6-12 chars
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="x-red">*</span>confirm password
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_repass" name="repass" lay-verify="repass"
                        autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button class="layui-btn" lay-filter="add" lay-submit="" type="button">
                    Edit
                </button>
            </div>
        </form>
    </div>
    <script>
        layui.use(['form', 'layer'], function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            form.on('submit(add)', function (data) {
                var id = data.field.id
                $.ajax({
                    type:'put',
                    dataType:'json',
                    data:data.field,
                    url:'/admin/user/' + id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        // console.log(data)
                        //发异步，把数据提交给php
                        if(data.code == 1){
                            layer.alert(data.msg, {
                                icon: 6
                            }, function () {
                                parent.location.reload(true);
                                // 获得frame索引
                                // var index = parent.layer.getFrameIndex(window.name);
                                //关闭当前frame
                                // parent.layer.close(index);
                                return false;
                            });
                        }else{
                            layer.alert(data.msg, {
                                icon: 5
                            })
                        }
                    },error:function(data){
                        // console.log(data)
                        layer.alert(data.responseText, {icon: 5})
                    }
                })
                
                
            });


        });
    </script>
</body>

</html>