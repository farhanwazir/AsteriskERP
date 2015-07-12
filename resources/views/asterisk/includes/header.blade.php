<?php
$logged_user = Auth::check()? Auth::user()->people : false;
$topbar = '<div class="container-fluid">';
$top_title = '<div class="navbar-header">
            <div class="dropdown ">
           <button type="button" class="navbar-brand brand-title dropdown-toggle btn" data-toggle="dropdown" title="Asterisk ERP"> <span class="glyphicon glyphicon-asterisk"></span></button>
                <ul class="dropdown-menu "  role="menu" aria-labelledby="Asterisk ERP">
                    <li class=""><a><strong>Asterisk ERP</strong></a></li>
                    <li class="'. Active::action('CompanyController@about') .'"><a href="'. action('CompanyController@about') .'">Company</a></li>
<li class="'. Active::action('CompanyController@guide') .'"><a href="'. action('CompanyController@guide') .'">User Guide</a></li>
<li class="'. Active::action('CompanyController@support') .'"><a href="'. action('CompanyController@support') .'">Support</a></li>
</ul>
</div>
</div>';
$navs = '<div>'.
    (($logged_user) ?

    '<ul class="nav navbar-nav">
        <li class="'. Active::action('CompanyController@about') .'"><a href="'. action('CompanyController@about') .'">Company</a></li>
        <li class="'. Active::action('CompanyController@guide') .'"><a href="'. action('CompanyController@guide') .'">User Guide</a></li>
        <li class="'. Active::action('CompanyController@support') .'"><a href="'. action('CompanyController@support') .'">Support</a></li>
    </ul><ul class="nav navbar-nav navbar-right">
        <li><a>'. $logged_user->first_name  .' '. $logged_user->last_name .', Welcome in Asterisk\'s world! </a></li>
        <li class="'. Active::action('AuthController@getLogout') .'"><a href="'. action('Auth\AuthController@getLogout') .'"><span class="glyphicon glyphicon-log-out"></span> Exit?</a></li>
    </ul>' :
    '<ul class="nav navbar-nav navbar-right">
        <li class="'. Active::action('AuthController@getLogin') .'"><a href="'. action('Auth\AuthController@getLogin') .'"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>')
    .'</div>';
$topbar .= $top_title . $navs . '</div>';
?>

@section('topbar')
    {!! $topbar !!}
@endsection

