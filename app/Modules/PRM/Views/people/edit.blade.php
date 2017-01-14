{{-- Edit people form --}}

@extends('PRM::includes.people.tmpl')

@section('prm_profile_contents')
    <h2>@lang('PRM::common.people.headings.edit')</h2>
    <p>@lang('PRM::common.people.descriptions.edit')</p>

    {!! Form::model($people, ['method'=>'PATCH', 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@update', $people->id], 'files' => true ] ) !!}
    {{-- Edit people form fields --}}
    @include('PRM::people.forms.people', ['edit' => true])
    {!! Form::close() !!}
@endsection
