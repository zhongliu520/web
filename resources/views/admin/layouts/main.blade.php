<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>后台管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    @yield('head')
    @stack('js')
    <link rel="shortcut icon" href="favicon.ico" />

</head>
    <!-- END HEAD -->

    @yield('content')

    <!-- END FOOTER -->
    <!--[if lt IE 9]>
    <script src="/admin/assets/global/plugins/respond.min.js"></script>
    <script src="/admin/assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="/admin/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <script src="/admin/assets/pages/layer/layer.js" type="text/javascript"></script>
    @yield('foot')
    <script>

    var is_request = false;
    function requestAjax(obj, callSuccess, callError)
    {
        if(is_request)
            return false;

        is_request = true;

        $.ajax({
            "url": obj.url,
            "data": obj.data,
            "type": obj.method,
            "dataType": "json",
            "success": function(json){
                is_request = false;

                if(json.code == 200)
                {
                    callSuccess(json);
                }else
                {

                    layer.alert(json.msg, {
                        icon: 2,
                        skin: 'layui-layer-lan' //样式类名
                        ,closeBtn: 0
                    });


                    if(!!callError)
                    {
                        callError(json);
                    }
                }
            },
            "error": function(){
                is_request = false;

                layer.alert("系统错误，请联系管理员", {
                    icon: 2,
                    skin: 'layui-layer-lan' //样式类名
                    ,closeBtn: 0
                });
            }
        });
    }


</script>

    @yield('foot-js')
</html>