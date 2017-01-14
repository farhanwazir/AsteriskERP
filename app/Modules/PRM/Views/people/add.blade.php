{{-- Add people form --}}

@extends('main', ['page_title' => trans('PRM::module.name'), 'heading' => trans('PRM::module.name'), 'slogan' => trans('PRM::module.version')])


@section('contents')
    <div class="container">
        <h2>@lang('PRM::common.people.headings.add')</h2>
        <p>@lang('PRM::common.people.descriptions.add')</p>

        <br><br>
        {!! Form::open(['action' => '\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@store', 'files' => true ]) !!}
        {{-- Add people form fields --}}
        @include('PRM::people.forms.people')
        {!! Form::close() !!}
    </div>
@endsection

