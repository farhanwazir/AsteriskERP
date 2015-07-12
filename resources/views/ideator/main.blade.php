<!DOCTYPE html>
<html>
@include('ideator.partials.header', [ 'page_title' => isset($page_title) ? $page_title : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ])
<body>
    <div id="body_container">
        @yield('body')
    </div>

@yield('footerScript')
</body>
</html>