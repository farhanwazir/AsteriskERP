<!DOCTYPE html>
<html>
@include('ideator.partials.header', [ 'page_title' => isset($page_title) ? $page_title : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ])
<body class="hold-transition skin-red sidebar-collapse sidebar-mini">
<div class="wrapper">
<!-- Reserved by Asterisk (views/asterisk/includes/app_menu.blade.php) -->
@yield('contents_before_contents')


        @yield('body')


</div>
<!-- Reserved by Asterisk (views/asterisk/includes/app_menu.blade.php)  -->
@yield('footer_scripts')




@yield('page_script')

</body>
</html>