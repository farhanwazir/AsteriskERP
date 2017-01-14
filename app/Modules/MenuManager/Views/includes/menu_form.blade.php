<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('slug', 'Slug') !!}
            {!! Form::text('slug', null, ['class' => 'form-control']) !!}
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
                <div class="form-group">
                    {!! Form::label('location', 'Location') !!}
                    {!! Form::text('location', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
