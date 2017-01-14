{{-- People profile --}}

@extends('PRM::includes.people.tmpl')

@section('prm_profile_contents')
            <h3>Personal Information
            {{-- Edit button --}}
                <div class="pull-right">
                    <div class="btn-group">
                        <a href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@edit', ['people' => $people->id]) !!}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>

                    </div>
                </div>
                {{-- End edit button --}}
            </h3>

            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.names.father') : </strong> {!! $people->father_name !!}
            </div>
            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.names.mother') : </strong> {!! $people->mother_name !!}
            </div>
            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.names.spouse') : </strong> {!! $people->spouse_name !!}
            </div>

            {{-- Vertical spacer small --}}<div class="col-sm-12 vspacer-small"></div>{{-- End vertical spacer small --}}

            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.gender') : </strong> {!! $people->sex !!}
            </div>
            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.dob') : </strong> {!! $people->birth_date . ' (' . $people->age . ')' !!}
            </div>
            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.birth_place') : </strong> {!! $people->place_of_birth !!}
            </div>

            {{-- Vertical spacer small --}}<div class="col-sm-12 vspacer-small"></div>{{-- End vertical spacer small --}}

            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.mobile_no') : </strong> {!! $people->mobile !!}
            </div>
            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.email') : </strong> {!! $people->email !!}
            </div>
            @if($people->occupation !== null)
            <div class="col-sm-4 col-as-box-simple">
                <strong>@lang('labels.occupation') : </strong> {!! App::make('occupation')->getTitle($people->occupation) !!}
            </div>
            @endif

            {{-- Vertical spacer small --}}<div class="col-sm-12 vspacer-small"></div>{{-- End vertical spacer small --}}
            @if(count($current = $people->currentContact()) > 0)
                <div class="col-sm-4 col-as-box-simple">
                    <strong>@lang('PRM::labels.countries.current') : </strong> {!! App::make('geo')->getCountryName($current->country_code) !!}
                </div>
            @endif
            @if(count($origin = $people->originContact()) > 0)
                <div class="col-sm-4 col-as-box-simple">
                    <strong>@lang('PRM::labels.countries.origin') : </strong> {!! App::make('geo')->getCountryName($origin->country_code) !!}
                </div>
            @endif


@endsection
