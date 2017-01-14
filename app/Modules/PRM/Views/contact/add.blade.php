{{-- Add people contact form page --}}
@extends('PRM::includes.people.tmpl')

@section('prm_profile_contents')
            <h3>@lang('PRM::common.contact.headings.add')</h3>
            <p>@lang('PRM::common.contact.descriptions.add')</p>

            <div class="row">
                <div class="col-sm-9">
                    {!! Form::open([ 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@store', $people->id] ]) !!}
                    @include('PRM::contact.forms.contact')
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-3">
                    {{-- Quick tips --}}
                    @include('PRM::contact.forms.tips.contact')
                    {{-- End quick tips --}}
                </div>
            </div>
@endsection
