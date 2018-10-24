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

    @yield('left_menu')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">

            @yield('page_bar')
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">
                {{--菜单列表--}}
                {{--<small>dashboard & statistics</small>--}}
            </h3>

            <div id="app">
                <meun-index-component></meun-index-component>
            <div>

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

@section('foot-js')

    {{--<script>--}}
        {{--$(document).ready(function() {--}}


            {{--TableDatatablesAjax.ajaxUrl = "/admin/meun/list";--}}
            {{--TableDatatablesAjax.init();--}}
        {{--});--}}
    {{--</script>--}}
@endsection

