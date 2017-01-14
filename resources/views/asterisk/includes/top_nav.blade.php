
{{-- LOGO --}}
<a class="logo" title="Asterisk ERP" href="http://www.cideator.com">
    <span class="logo-mini "><span class="mf icon-asterik"></span></span>
    <span class="logo-lg"><span class="mf icon-asterik"></span> Asterisk ERP</span>
</a>
{{-- End LOGO --}}



{{-- Navigation --}}
<nav class="navbar navbar-static-top " role="navigation">
    {{-- Sidebar menu toggle button --}}
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a> {{-- End toggle button --}}

    @if(Auth::check()) {{-- If user is logged in --}}

    {{-- Application generate menu of location: top --}}
    <!-- ul id="main-menu" class="nav navbar-nav">
        {{ Menu::getMenu('top', true) }}
    </ul -->
    @endif

    {{-- Right menu --}}
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            @if(Auth::check())

                {{-- User Menu --}}
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset(Config::get('asterisk.prm.people.photo.path') . Auth::user()->people->photo) }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{!! Auth::user()->people->full_name !!}</span>
                    </a>
                    {{-- dropdown user menu --}}
                    <ul class="dropdown-menu">
                        {{-- User image --}}
                        <li class="user-header">
                            <img src="{{ asset(Config::get('asterisk.prm.people.photo.path') . Auth::user()->people->photo) }}" class="img-circle" alt="User Image">
                            <p>
                                {!! Auth::user()->people->full_name !!}
                                <small>Member since {!! \Carbon\Carbon::parse(Auth::user()->people->created_at)->format('M, Y') !!}</small>
                            </p>
                        </li>
                        {{-- Menu Body --}}
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        {{-- Menu Footer--}}
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@show', ['id' => Auth::user()->people->id]) }}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ action('Auth\AuthController@getLogout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul> {{-- End dropdown user menu --}}
                </li> {{-- End User menu --}}
            @else
                {{-- If not logged in user menu --}}
                <li>
                    <a href="{{ url('/') }}"><i class="glyphicon glyphicon-log-in"> </i> Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
