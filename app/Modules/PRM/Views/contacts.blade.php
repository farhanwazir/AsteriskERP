{{-- People contacts page --}}

@extends('PRM::includes.people.tmpl')

@section('prm_profile_contents')

    <h3>Contacts Detail
        {{-- button --}}
        <div class="pull-right">
            <div class="btn-group">
                <a href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@create', ['people' => $people->id]) !!}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span> Add Contact
                </a>
            </div>
        </div>
        {{-- End button --}}
    </h3>
    <div class="row"><!-- Featured row -->
        @foreach($contacts->featured as $contact)

            <div class="col-sm-6">
                <div class="box @if($contact->is_origin) box-info @elseif($contact->is_current) box-warning @else box-default @endif">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <span class="mf @if($contact->is_origin) icon-home @else icon-map-maker-o @endif"></span>
                            {!! $contact->country_flag .' '. $contact->title !!}
                        </h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-warning" href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@edit', ['people' => $people->id, 'contact' => $contact->id]) !!}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <div class="actoin-inline">
                                {!! Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirmBox("Are you sure to delete, '. $contact->title .' contact?")', 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@destroy', 'people' => $people->id, 'contact' => $contact->id ] ])  !!}
                                {!! Form::button(' ', ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'type' => 'submit'])  !!}
                                {!! Form::close() !!}
                            </div>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-6">

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong>@lang('labels.address') </strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! $contact->address != null ? $contact->address : '--' !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong>@lang('labels.state')/@lang('labels.province')</strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! ($contact->state != null ? $contact->state : '--') .'/'. ($contact->province != null ? $contact->province : '--') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong>@lang('labels.city')/@lang('labels.country')</strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! ($contact->city != null ? $contact->city : '--') .'/'. ($contact->country != null ? $contact->country_flag .' '. $contact->country : '--') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong> @lang('labels.zip_or_postal') </strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! $contact->zipcode != null ? $contact->zipcode : '--' !!}
                                </div>
                            </div>
                        </div> <!-- Left Column End -->

                        <div class="col-sm-6"><!-- Right Column Start -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong> @lang('labels.nationality') </strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! $contact->nationalityType->title !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong> @lang('labels.phone_no') </strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! ($contact->phone_area_code != null ? $contact->phone_area_code : '--') .' '. ($contact->phone != null ? $contact->phone : '--') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong> @lang('labels.mobile_no') </strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! $contact->mobile != null ? $contact->mobile : '--' !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <strong> @lang('labels.secondary_short') @lang('labels.mobile_no') </strong>
                                </div>
                                <div class="col-sm-12">
                                    {!! $contact->sec_mobile != null ? $contact->sec_mobile : '--' !!}
                                </div>

                            </div>

                        </div> <!-- Right Column End -->

                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            </div>

        @endforeach
    </div><!-- End featured row -->

    <div class="row"> <!-- Non featured row -->
        @foreach($contacts->non_featured as $contact)

            <div class="col-sm-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $contact->title }}</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-warning" href="{!! action('\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@edit', ['people' => $people->id, 'contact' => $contact->id]) !!}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <div class="actoin-inline">
                                {!! Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirmBox("Are you sure to delete, '. $contact->title .' contact?")', 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\ContactController@destroy', 'people' => $people->id, 'contact' => $contact->id ] ])  !!}
                                {!! Form::button(' ', ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'type' => 'submit'])  !!}
                                {!! Form::close() !!}
                            </div>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">


                        <div class="row">
                            <div class="col-sm-4">
                                <strong> @lang('labels.nationality') </strong>
                            </div>
                            <div class="col-sm-8">
                                {!! $contact->nationalityType->title !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <strong>@lang('labels.address') </strong>
                            </div>
                            <div class="col-sm-8">
                                {!! $contact->address != null ? $contact->address : '--' !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>@lang('labels.state')/@lang('labels.province')</strong>
                            </div>
                            <div class="col-sm-8">
                                {!! ($contact->state != null ? $contact->state : '--') .'/'. ($contact->province != null ? $contact->province : '--') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong>@lang('labels.city')/@lang('labels.country')</strong>
                            </div>
                            <div class="col-sm-8">
                                {!! ($contact->city != null ? $contact->city : '--') .'/'. ($contact->country != null ? $contact->country_flag .' '. $contact->country : '--') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong> @lang('labels.zip_or_postal') </strong>
                            </div>
                            <div class="col-sm-8">
                                {!! $contact->zipcode != null ? $contact->zipcode : '--' !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong> @lang('labels.phone_no') </strong>
                            </div>
                            <div class="col-sm-8">
                                {!! ($contact->phone_area_code != null ? $contact->phone_area_code : '--') .' '. ($contact->phone != null ? $contact->phone : '--') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong> @lang('labels.mobile_no') </strong>
                            </div>
                            <div class="col-sm-8">
                                {!! $contact->mobile != null ? $contact->mobile : '--' !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong> @lang('labels.secondary_short') @lang('labels.mobile_no') </strong>
                            </div>
                            <div class="col-sm-8">
                                {!! $contact->sec_mobile != null ? $contact->sec_mobile : '--' !!}
                                {!! $text !!}
                            </div>

                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>

        @endforeach
    </div><!-- End non featured row -->

@endsection