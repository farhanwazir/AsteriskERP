{{-- Add people contact form page --}}
@extends('PRM::includes.people.tmpl')

@section('prm_profile_contents')
            <h3>@lang('PRM::common.contact.headings.edit')</h3>
            <p>@lang('PRM::common.contact.descriptions.edit')</p>

            <div class="row">
                <div class="col-sm-9">
                    {!! Form::model($contact, ['method' => 'PATCH', 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@update', 'people' => $people->id, 'contact' => $contact->id ] ]) !!}
                    @include('PRM::contact.forms.contact', ['edit' => true])
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-3">
                    {{-- Quick tips --}}
                    @include('PRM::contact.forms.tips.contact')
                    {{-- End quick tips --}}
                </div>
            </div>
@endsection
