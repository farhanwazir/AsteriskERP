{{-- People Profile Main Template --}}
@extends('main', ['page_title' => trans('PRM::module.name'), 'heading' => trans('PRM::module.name'), 'slogan' => trans('PRM::module.version')])


@section('contents')
    {{-- People Profile Header --}}
    <div class="row">
        <div class="col-sm-5">
            <h2 class="profile-heading-fix-margin">{!! trans('PRM::common.people.headings.profile', ['people_name' => $people->full_name ]) !!}</h2>
        </div>
        <div class="col-sm-7">
            @include("PRM::includes.people.navigation")
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            {{-- Left column --}}

            {{-- Display Picture --}}
            {{-- People display picture --}}

            {{-- Editable profile display picture.
                             Here I have used JASNY JQuery Plugin --}}
            {!! Form::model($people, ['method'=>'PATCH', 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@updateDisplayPic', $people->id], 'files' => true]) !!}
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" >
                    {{-- Picture source code, this code will return display picture with <img /> tag.
                         If you want simple call filename then you can call $people->photo. --}}
                    {!! $people->display_pic !!}

                </div>
                {{-- Width and height fetch from base configuration file Asterisk.php, which is located in App/Config forlder. --}}
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: {!! Config::get('asterisk.prm.people.photo.width') !!}px; max-height: {!! Config::get('asterisk.prm.people.photo.height') !!}px;"></div>
                <div class="fly-right-down">
                    <span class="btn btn-warning btn-file"><span class="fileinput-new"><span class="glyphicon glyphicon-camera"></span> </span><span class="fileinput-exists"><span class="glyphicon glyphicon-refresh"></span> </span> <input type="file" name="photo"></span>
                    <span class="fileinput-exists"><button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> </button></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
            </div>
            {!! Form::close() !!}

            {{-- End left column --}}
        </div>

        <div class="col-sm-10">
            {{-- Right column --}}
            @yield('prm_profile_contents')
            {{-- End right column --}}
        </div>
    </div>
@endsection