@extends('main', ['page_title' => trans('MenuManager::module.name'), 'heading' => trans('MenuManager::module.name'), 'slogan' => trans('MenuManager::module.version')])

@section('contents')
    <div class="container">
        <h2>Create Menu Item</h2>
        {!! Form::open(['action' => ['\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@itemStore', $menu]]) !!}
        @include('asterisk.includes.errors')
        @include('MenuManager::includes.item_form')

        <div class="col-sm-1">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! form::close() !!}
    </div>
@endsection