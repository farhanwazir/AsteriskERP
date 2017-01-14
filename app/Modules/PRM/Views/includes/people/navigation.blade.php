{{-- People Profile Navigations --}}

<nav class="navbar navbar-default pull-right" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
            <li>
                <a href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@show', ['people' => $people->id]) !!}">@lang('PRM::labels.navigation.profile')</a>
            </li>
            <li>
                <a href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@index', ['people' => $people->id]) !!}">@lang('PRM::labels.navigation.contacts')</a>
            </li>
            <li>
                <a href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@index', ['people' => $people->id]) !!}">@lang('PRM::labels.navigation.educations')</a>
            </li>
            <li>
                <a href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@index', ['people' => $people->id]) !!}">@lang('PRM::labels.navigation.experiences')</a>
            </li>
        </ul>
    </div>
</nav>