@extends('main', ['page_title' => 'File not found'])

@section('contents')
    <div class="error-page">
        <h2 class="headline text-yellow"> {!! trans('errors.503.code') !!}</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> {!! trans('errors.503.heading') !!}</h3>
            <p>
                {!! trans('errors.503.msg') !!}
            </p>

        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection