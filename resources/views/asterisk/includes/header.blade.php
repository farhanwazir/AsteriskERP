<?php
//$logged_user variable is also using for script including, meta tags and many other places.
//DON'T DELETE IT
$logged_user = Auth::check()? Auth::user()->people : false; //DON'T DELETE


$topbar = ''; //'<div class="container-fluid">';
$top_title = '<div class="navbar-header">
            <a class="navbar-brand brand-title btn" title="Asterisk ERP" href="http://www.cideator.com"> <span class="glyphicon glyphicon-asterisk"></span></a>
            </div>';


$top_title = '<a class="logo" title="Asterisk ERP" href="http://www.cideator.com">
        <span class="logo-mini "><span class="mf icon-asterik"></span></span>
        <span class="logo-lg"><span class="mf icon-asterik"></span> Asterisk ERP</span>
    </a>';

$navs = '<nav class="navbar navbar-static-top " role="navigation">
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">'. //<div class="collapse navbar-collapse">
    (($logged_user) ?
    '<ul id="main-menu" class="nav navbar-nav">'.
        Menu::getMenu('top', true)
    .'</ul>

    <ul class="nav navbar-nav ">
        <li><a>'. $logged_user->first_name  .' '. $logged_user->last_name .', Welcome in Asterisk\'s world! </a></li>
        <li class="'. Active::action('AuthController@getLogout') .'"><a href="'. action('Auth\AuthController@getLogout') .'"><span class="glyphicon glyphicon-log-out"></span> Exit?</a></li>
    </ul>' :
    '<ul class="nav navbar-nav navbar-right">
        <li class="'. Active::action('AuthController@getLogin') .'"><a href="'. action('Auth\AuthController@getLogin') .'"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>')
    .'</div></nav>';
$topbar .= $top_title . $navs; // . '</div>';
?>


@section('header_attachments')
    {{-- Remove comment on production

    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/public{ elixir('js/app.js') }}"></script>
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/public{ elixir('css/all.css') }}" />
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/public{ elixir('css/app.css') }}" />
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/public{ elixir('css/app.css') }}" />
    --}}
    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/jquery/dist/jquery.min.js"></script>

    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/bootstrap/dist/css/bootstrap.css" />
    <!-- link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/bootstrap/dist/css/bootstrap-theme.css" / -->
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/admin-lte/dist/css/AdminLTE.css" />
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/admin-lte/dist/css/skins/_all-skins.css" />

    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/bootstrap-form-helpers/dist/js/bootstrap-formhelpers.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/bootstrap-form-helpers/dist/css/bootstrap-formhelpers.css" />

    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/admin-lte/dist/js/app.js"></script>

    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/custom-js/typeahead/typeahead.bundle.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/custom-js/handlebars.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/custom-js/meny.3dmenu.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/custom-js/multi_level_navbar.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/custom-js/general.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/jquery-datetextentry/jquery.datetextentry.js"></script>

    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/custom-css/meny.css" />
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/custom-css/multi_level_navbar.css" />
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/jquery-datetextentry/jquery.datetextentry.css" />
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/MagicalFont/src/magicalfont.css" />
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/custom-css/style.css" />

    <script type="text/javascript" src="http://127.0.0.1/AsteriskERP/resources/assets/jasny-bootstrap/dist/js/jasny-bootstrap.js"></script>
    <link rel="stylesheet" href="http://127.0.0.1/AsteriskERP/resources/assets/jasny-bootstrap/dist/css/jasny-bootstrap.css" />
    @if($logged_user)

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @endif

    <!-- Respond.js for IE8 support of media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!---------------- END ---------------------->

@endsection





<!-- Don't Touch Below -->

<!-- Meta Tags -->
@include('asterisk.includes.meta_tags')


<!-- Left Menu -->
@if($logged_user)
@section('contents_before_contents')
    <div class="meny">
        <h3>Discover Asterisk</h3>
        <div class="panel-group" id="aerp-left-menu">
            <?php
            $menus = Menu::getRawMenusByLocation();
            foreach($menus as $menu){
                $inactive_panel_class = 'collapse';
                $active_panel = 'active-panel';
                $panel = '<div class="panel panel-default">
            <div class="panel-heading {active-panel}">
                {title}
            </div>
            <div id="menu-'. $menu->id .'" class="panel-collapse {in-class}">
                <ul class="nav nav-pills nav-stacked">';
                    foreach($menu->items as $item){
                    $href_method = $item->method;
                    $href = $href_method($item->action);
                    $current = (Request::url() == $href);
                    if($current) $inactive_panel_class ='';
                    $panel .= '<li><a href="'. $href .'" '. (($current)? 'class="active"' : '') .'> '. $item->title .' </a></li>';
                    }
                    $panel .= '</ul></div></div>';

        echo str_replace(array('{title}', '{active-panel}'),
        (($inactive_panel_class == '')? array('<a>'.$menu->title.'</a>', $active_panel) :
        array('<a data-toggle="collapse" data-parent="#aerp-left-menu" href="#menu-'. $menu->id .'"> '. $menu->title .'</a>', '') ),
        str_replace('{in-class}', $inactive_panel_class, $panel));

        }
        ?>
    </div>
    </div>
@endsection

@section('footer_scripts')
    <script type="text/javascript">
        var meny = Meny.create({
            // The element that will be animated in from off screen
            menuElement: document.querySelector( '.meny' ),

            // The contents that gets pushed aside while Meny is active
            contentsElement: document.querySelector( '.contents' ),

            // The alignment of the menu (top/right/bottom/left)
            position: 'left',

            // The height of the menu (when using top/bottom position)
            height: 200,

            // The width of the menu (when using left/right position)
            width: 260,

            // The angle at which the contents will rotate to.
            angle: 0,

            // The mouse distance from menu position which can trigger menu to open.
            threshold: 60,

            // Width(in px) of the thin line you see on screen when menu is in closed position.
            overlap: 0,

            // The total time taken by menu animation.
            transitionDuration: '0.5s',

            // Transition style for menu animations
            transitionEasing: 'ease',

            // Gradient overlay for the contents
            gradient: 'rgba(0,0,0,0.20) 0%, rgba(0,0,0,0.65) 100%)',

            // Use mouse movement to automatically open/close
            mouse: true,

            // Use touch swipe events to open/close
            touch: true
        });



    </script>
@endsection
@endif
