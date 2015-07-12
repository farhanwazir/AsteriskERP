@extends('main')
@include('asterisk.includes.header')

@section('contents')
    <div class="container">
        <h2>Create Menu</h2>
        {!! Form::open(['action' => '\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@store']) !!}
        @include('asterisk.includes.errors')
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-sm-1">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! form::close() !!}
    </div>
@endsection