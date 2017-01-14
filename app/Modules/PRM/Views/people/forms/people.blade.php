{{-- Add People Form --}}

<div class="row">
    @if(!isset($edit))
    <div class="col-sm-3">

            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;"></div>
                <div>
                    <span class="btn btn-warning btn-file"><span class="fileinput-new">@lang('PRM::form.people.buttons.upload_dp')</span><span class="fileinput-exists">@lang('PRM::form.people.buttons.change_dp')</span><input type="file" name="photo"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">@lang('PRM::form.people.buttons.remove_dp')</a>
                </div>
            </div>
    </div>
    <div class="col-sm-9">
    @else
    <!-- expend full width in edit mode -->
    <div class="col-sm-12">
    @endif
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    {!! Form::label('first_name', trans('labels.names.first') ) !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    {!! Form::label('last_name', trans('labels.names.last') ) !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    {!! Form::label('sex', trans('labels.gender') ) !!}
                    {!! Form::select('sex', [
                                                'male' => trans('labels.genders.male'),
                                                'female' => trans('labels.genders.female'),
                                                'shemale' => trans('labels.genders.shemale')
                                            ], 'male', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('father_name', trans('labels.names.father') ) !!}
                    {!! Form::text('father_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('mother_name', trans('labels.names.mother')) !!}
                    {!! Form::text('mother_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('spouse_name', trans('labels.names.spouse') ) !!}
                    {!! Form::text('spouse_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('dob', trans('labels.dob') ) !!}
                            <!-- added extra form-control div for jquery date of birth plugin -->
                    <div class="form-control">
                        {!! Form::text('dob', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                {!! Form::label('place_of_birth', trans('labels.birth_place')) !!}
                {!! Form::text('place_of_birth', null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('country_code', trans('labels.country_code') ) !!}
                    <select id="country_code" name="country_code" class="form-control bfh-countries" data-country="{{ $people->country_code or 'OM' }}" data-flags="true"></select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('mobile', trans('labels.mobile') ) !!}
                    {!! Form::text('mobile', null, ['class' => 'form-control bfh-phone', 'data-country' => 'country_code' ]) !!}
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('occupation', trans('labels.occupation') ) !!}
                    {!! Form::select('occupation', App::make('occupation')->getAllSelectValues(), null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('email', trans('labels.email') ) !!}
                    {!! Form::text('email', null, ['class' => 'form-control' ]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                {!! Form::submit(isset($edit) ? trans('form.buttons.update') : trans('form.buttons.submit'), ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
        </div>
    </div>
</div>



        @section('page_script')
            <script type="text/javascript">
                $('document').ready(function(){
                    //code
                    $('#dob').datetextentry();
                    @if(!isset($edit))
                        $('.fileinput').fileinput({
                            name    :   'photo'
                        });
                    @endif
                });
            </script>
        @endsection