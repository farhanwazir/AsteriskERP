{{-- Contact Add Form --}}
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('title', trans('labels.title') ) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('nationality_type', trans('labels.nationality') ) !!}
            {!! Form::text('nationality_type', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('country_code', trans('labels.country') ) !!}
            <select id="country_code" name="country_code" class="form-control bfh-countries" data-country="{{ $contact->country_code or 'PK' }}" data-flags="true"></select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address', trans('labels.address') ) !!}
            {!! Form::text('address', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('state', trans('labels.state') ) !!}
            {!! Form::text('state', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('province', trans('labels.province') ) !!}
            {!! Form::text('province', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('city', trans('labels.city') ) !!}
            {!! Form::text('city', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('zipcode', trans('labels.zip_or_postal') ) !!}
            {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('phone_area_code', trans('labels.phone_area_code_short') ) !!}
                {!! Form::text('phone_area_code', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                {!! Form::label('phone', trans('labels.phone_no') ) !!}
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('mobile', trans('labels.mobile_no') ) !!}
            {!! Form::text('mobile', null, ['class' => 'form-control bfh-phone', 'data-country' => 'country_code']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('sec_mobile', trans('labels.secondary_short').' '.trans('labels.mobile_no') ) !!}
            {!! Form::text('sec_mobile', null, ['class' => 'form-control bfh-phone', 'data-country' => 'country_code']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('is_current', 1, true) !!} {!! trans('PRM::labels.is_current') !!}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('is_origin', 1, null) !!} {!! trans('PRM::labels.is_origin') !!}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        @if((config('asterisk.prm.people.contacts.multi_contacts') || (config('asterisk.prm.people.contacts.only_multi_contacts') && !config('asterisk.prm.people.contacts.multi_contacts'))) && !isset($edit))
            <div class="form-group pull-right left-padding-10">
                {{-- Check config if multi contacts add feature on then below line code will be activated --}}
                {!!  Form::submit( trans('form.buttons.submit_add_more'), ['class' => 'btn btn-info', 'name' => 'add_more']) !!}
            </div>
        @endif

        @if(!config('asterisk.prm.people.contacts.only_multi_contacts') || isset($edit))
            <div class="form-group pull-right">
                {{-- Simple submit button --}}
                {!! Form::submit(isset($edit) ? trans('form.buttons.update') : trans('form.buttons.submit'), ['class' => 'btn btn-primary']) !!}
            </div>
        @endif

        {!! Form::hidden('people', $people->id) !!}

        {{-- Contact id required for request title duplication check in update only --}}
        @if(isset($edit))
            {!! Form::hidden('contact', $contact->id) !!}
        @endif
    </div>
</div>