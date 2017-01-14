<!DOCTYPE html>
<html>
<head>
    <title>{{ $page_title or 'Asterisk ERP' }}</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- Tell the browser to be responsive to screen width --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('asterisk.includes.meta_tags')
    @include('asterisk.includes.header_scripts_styles')

</head>

<body class="skin-red sidebar-collapse sidebar-mini fixed">
<div class="wrapper">
    @include('includes.header')

    {{-- Left Sidebar --}}
    @if (isset($__env->getSections()['left_sidebar']))
        <div class="sidebar-wrapper">
            <aside class="main-sidebar">
                @yield('left_sidebar')
            </aside>{{-- /.main-sidebar --}}
        </div>
    @endif

    {{-- Content Wrapper. Contains page content --}}
    <div class="content-wrapper">
        @if(isset($heading))
            {{-- Content Header (Page header) --}}
            <section class="content-header">
                <h1>
                    {!! $heading !!}
                    <small>{!! $slogan or '' !!}</small>
                </h1>
                <!-- TODO: Breadcrumb is listed in future addition
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Widgets</li>
                </ol>
                -->
            </section>
        @endif

        {{-- Error Container --}}
        <div class="messages-container flash">
            @include('flash::message')
        </div>

        {{-- Error Container --}}
        <div class="messages-container errors">
            @include('asterisk.includes.errors')
        </div>

        @if (isset($__env->getSections()['contents']))
            {{-- Main content --}}
            <div class="content">
                @yield('contents')
            </div>
        @endif
    </div>

    @include('includes.footer')

    @if (isset($__env->getSections()['right_sidebar']))
        {{-- Control Sidebar --}}
        <aside class="control-sidebar control-sidebar-dark">
            @yield('right_sidebar')
        </aside>{{-- /.control-sidebar --}}
        {{-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar --}}
        <div class="control-sidebar-bg"></div>
    @endif

</div>

{{-- Reserved by Asterisk (views/asterisk/includes/app_menu.blade.php)  --}}
@yield('footer_scripts')

@yield('page_script')

</body>
</html>

