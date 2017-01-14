<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-6">
                <!-- TODO: In future it will change into icon selector box -->
                <div class="form-group">
                    {!! Form::label('icon_class', 'Icon class') !!}
                    {!! Form::text('icon_class', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <!-- TODO: In future select box will appear with all possible laravel methods -->
                <div class="form-group">
                    {!! Form::label('method', 'Method') !!}
                    {!! Form::text('method', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <!-- TODO: In future searchable actions will be introduces by laravel Route::getRoutes() method.
            for example: php artisan route:list -->
        <div class="form-group">
            {!! Form::label('action', 'Action') !!}
            {!! Form::text('action', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>