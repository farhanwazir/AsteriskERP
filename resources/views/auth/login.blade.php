@extends('main', ['page_title' => 'User Login', 'heading' => 'System Authentication'])

@section('contents')

    <div class="content row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            {!! Form::open(['role' => 'form']) !!}

            <h1>Login</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your credentials.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                {!! Form::text('email','',array('id'=>'','class'=>'form-control input-lg','placeholder' => 'Please Enter your Email')) !!}

            </div>

            <div class="form-group">
                {!! Form::password('password',array('class'=>'form-control input-lg', 'placeholder'=>'Please Enter your Password')) !!}
            </div>

            <div class="checkbox input-lg">
                <label> {!! Form::checkbox('remember',1,null) !!} Remember Me</label>

            </div>

            <p>{!! Form::submit('Login', array('class'=>'btn-default btn btn-lg')) !!}</p>

            {!! Form::close() !!}
        </div>
        <div class="col-md-4"></div>
    </div>

@endsection