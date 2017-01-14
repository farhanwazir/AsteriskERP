@extends('main', ['page_title' => trans('MenuManager::module.name'), 'heading' => trans('MenuManager::module.name'), 'slogan' => trans('MenuManager::module.version')])

@section('contents')
    <div class="container">
        <h2>Edit Item</h2>
        {!! Form::model($item, ['method'=>'PATCH', 'action' => ['\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@itemUpdate', $menu.'/'.$item->id ]]) !!}
        @include('asterisk.includes.errors')
        @include('MenuManager::includes.item_form')

        <div class="col-sm-1">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! form::close() !!}
    </div>
@endsection