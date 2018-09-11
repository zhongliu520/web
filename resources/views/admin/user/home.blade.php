@include('admin.layouts.common_public')
@extends('admin.layouts.main')


<!-- END HEAD -->
@section('content')
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

@yield('top')

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">

    @yield('left_meun')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->
            {{--<div class="theme-panel hidden-xs hidden-sm">--}}
                {{--<div class="toggler"> </div>--}}
                {{--<div class="toggler-close"> </div>--}}
                {{--<div class="theme-options">--}}
                    {{--<div class="theme-option theme-colors clearfix">--}}
                        {{--<span> THEME COLOR </span>--}}
                        {{--<ul>--}}
                            {{--<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>--}}
                            {{--<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>--}}
                            {{--<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>--}}
                            {{--<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>--}}
                            {{--<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>--}}
                            {{--<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Theme Style </span>--}}
                        {{--<select class="layout-style-option form-control input-sm">--}}
                            {{--<option value="square" selected="selected">Square corners</option>--}}
                            {{--<option value="rounded">Rounded corners</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Layout </span>--}}
                        {{--<select class="layout-option form-control input-sm">--}}
                            {{--<option value="fluid" selected="selected">Fluid</option>--}}
                            {{--<option value="boxed">Boxed</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Header </span>--}}
                        {{--<select class="page-header-option form-control input-sm">--}}
                            {{--<option value="fixed" selected="selected">Fixed</option>--}}
                            {{--<option value="default">Default</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Top Menu Dropdown</span>--}}
                        {{--<select class="page-header-top-dropdown-style-option form-control input-sm">--}}
                            {{--<option value="light" selected="selected">Light</option>--}}
                            {{--<option value="dark">Dark</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Sidebar Mode</span>--}}
                        {{--<select class="sidebar-option form-control input-sm">--}}
                            {{--<option value="fixed">Fixed</option>--}}
                            {{--<option value="default" selected="selected">Default</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Sidebar Menu </span>--}}
                        {{--<select class="sidebar-menu-option form-control input-sm">--}}
                            {{--<option value="accordion" selected="selected">Accordion</option>--}}
                            {{--<option value="hover">Hover</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Sidebar Style </span>--}}
                        {{--<select class="sidebar-style-option form-control input-sm">--}}
                            {{--<option value="default" selected="selected">Default</option>--}}
                            {{--<option value="light">Light</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Sidebar Position </span>--}}
                        {{--<select class="sidebar-pos-option form-control input-sm">--}}
                            {{--<option value="left" selected="selected">Left</option>--}}
                            {{--<option value="right">Right</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="theme-option">--}}
                        {{--<span> Footer </span>--}}
                        {{--<select class="page-footer-option form-control input-sm">--}}
                            {{--<option value="fixed">Fixed</option>--}}
                            {{--<option value="default" selected="selected">Default</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- END THEME PANEL -->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
                {{--<div class="page-toolbar">--}}
                    {{--<div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">--}}
                        {{--<i class="icon-calendar"></i>&nbsp;--}}
                        {{--<span class="thin uppercase hidden-xs"></span>&nbsp;--}}
                        {{--<i class="fa fa-angle-down"></i>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Dashboard
                <small>dashboard & statistics</small>
            </h3>
            <!-- END PAGE TITLE-->

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2014 &copy; Metronic by keenthemes.
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>



</body>
@endsection

