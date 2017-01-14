@extends('main', ['page_title' => trans('MenuManager::module.name'), 'heading' => trans('MenuManager::module.name'), 'slogan' => trans('MenuManager::module.version')])

@section('contents')
    <div class="container">
        <h2>{!! trans('MenuManager::common.main.headings.edit') !!}</h2>
        {!! Form::model($menu, ['method'=>'PATCH', 'action' => ['\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@update', $menu->id]]) !!}

        @include('MenuManager::includes.menu_form')

        <div class="col-sm-1">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! form::close() !!}
    </div>
@endsection