@extends('main', ['page_title' => trans('MenuManager::module.name'), 'heading' => trans('MenuManager::module.name'), 'slogan' => trans('MenuManager::module.version')])

@section('contents')
    <div class="container">
        <h2>{!! trans('MenuManager::common.main.headings.create') !!}</h2>
        {!! Form::open(['action' => '\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@store']) !!}

        @include('MenuManager::includes.menu_form')

        <div class="col-sm-1">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! form::close() !!}
    </div>
@endsection