@extends('admin.layouts.main')

<?php function showMeunLi($chils){?>
    <?php if(!empty($chils)){?>
        <ul class="sub-menu">
            <?php foreach($chils as $v){?>
                <li class="nav-item start">
                    <a href="index.html" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">{{ $v["name"]  }}</span>
                        <span class="selected"></span>
                    </a>
                    <?php showMeunLi($v["chil"])?>
                </li>
            <?php }?>
        </ul>
    <?php }?>
<?php }?>

@section('left_meun')

    <div class="page-sidebar-wrapper">

        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                @foreach($meuns as $v)

                    <li class="nav-item start active open">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-home"></i>
                            <span class="title">{{ $v["name"]  }}</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <?php showMeunLi($v["chil"])?>
                    </li>

                @endforeach
            </ul>

        </div>

    </div>

@endsection