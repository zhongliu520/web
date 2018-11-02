@section('top')
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
                <img src="/admin/assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
            {{--<div class="menu-toggler sidebar-toggler"> </div>--}}
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="/admin/assets/layouts/layout/img/avatar3_small.jpg" />
                        <span class="username username-hide-on-mobile"> {{ Auth::guard("admin")->user()->toArray()["name"] }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">

                        <li>
                            <a href="/admin/logout">
                                <i class="icon-key"></i>退出 </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->

            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
@endsection

@section('head')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    {{--<link href="/admin/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />--}}
    <link href="/admin/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/admin/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/admin/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
@endsection



@section('foot')
<script>
    $(".nav-item.start").on("click", function () {
        if($(this).attr("class").match(/open/))
        {
//            $(this).removeClass("active");
            $(this).removeClass("open");
            $(this).find("a").eq(0).find("span").eq(1).removeClass("open");

            $(this).find(".sub-menu").attr("style", "display: none");
        }else
        {
//            $(this).addClass("active");
            $(this).addClass("open");
            $(this).find("a").eq(0).find("span").eq(1).addClass("open");

            $(this).find(".sub-menu").attr("style", "display: block;");
        }
    });
</script>
@endsection

<?php function showMenuLi($chils, $active){?>
    <?php if(!empty($chils)){?>
        <ul class="sub-menu" <?php if($active == 1) {?>style="display: block;"<?php }?>>
            <?php foreach($chils as $v){?>

                <li class="nav-item start <?php echo $v["active"]==1? "active open": "";?>">

                <?php if(!empty($v["chil"])){?>
                    <a href="javascript:;" class="nav-link nav-toggle">
                <?php }else { ?>
                    <a href="{{ $v["url"]  }}" class="nav-link ">
                <?php }?>

                        <i class="{{ $v["icon"] }}"></i>
                        <span class="title">{{ $v["name"]  }}</span>
                        <span class="arrow <?php echo $v["active"]==1? "open": "";?>"></span>
                    </a>
                    <?php showMenuLi($v["chil"], $v["active"])?>
                </li>
            <?php }?>
        </ul>
    <?php }?>
<?php }?>

@section('left_menu')

    <div class="page-sidebar-wrapper">

        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                @foreach($menuData["menus"] as $v)

                    <li class="nav-item start <?php echo $v["active"]==1? "active open": "";?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="{{ $v["icon"] }}"></i>
                            <span class="title">{{ $v["name"]  }}</span>
                            {{--<span class="selected"></span>--}}
                            <span class="arrow <?php echo $v["active"]==1? "open": "";?>"></span>
                        </a>
                        <?php showMenuLi($v["chil"], $v["active"])?>
                    </li>

                @endforeach
            </ul>

        </div>

    </div>

@endsection

@section('page_bar')

    <div class="page-bar">
        <ul class="page-breadcrumb">
            @foreach($menuData["pageBar"] as $k=>$v)
                @if(($k+1)<count($menuData["pageBar"]))
                <li>
                    <a href="{{ $v["url"] }}">{{ $v["name"] }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                @else
                    <li>
                        <span>{{ $v["name"] }}</span>
                    </li>
                @endif
            @endforeach
        </ul>

    </div>
    <!-- END PAGE BAR -->

@endsection