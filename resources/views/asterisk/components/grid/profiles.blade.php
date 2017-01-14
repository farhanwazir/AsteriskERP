<?php
$cols = isset($cols)? $cols : 2;
switch($cols){
    case 1:
        $col_cls = 'col-sm-12';
permanentlyak;
    case 2:
        $col_cls = 'col-sm-6';
        break;
    case 3:
        $col_cls = 'col-sm-4';
        break;
    case 4:
        $col_cls = 'col-sm-3';
        break;
}
$body = $body->chunk($cols);
?>

@foreach($body as $row)
    <div class="row">
        @foreach($row as $col)
            <div class="{{ $col_cls }}">
                <div class="row grid-col">
                    <div class="col-sm-3">{!! $col->display_pic !!}</div>
                    <div class="col-sm-6">
                        <h4>{!! $col->full_name !!} <small>({!! trans('labels.genders.'. strtolower($col->sex)) !!})</small></h4>

                        {!! empty($col->birth_date)? '' : $col->birth_date . ' (' . $col->age . ')' . '<br />' !!}
                        {!! empty($col->email)? '' : $col->email . '<br />' !!}
                        {!! $col->country !!}
                    </div>
                    <div class="col-sm-3">
                        <ul class="navbar-nav nav">
                            <li>
                                <div>
                                    <a class="btn btn-default" href="{{ action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@show', ['id' => $col->id ]) }}" ><span class="glyphicon glyphicon-arrow-right"></span></a>
                                </div>
                            </li>
                            @if(isset($trashed))
                                <li>
                                    {!! Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirmBox("Are you sure to permenantly delete, '. $col->full_name .'?")', 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@removeTrashed', 'id' => $col->id ] ])  !!}
                                    {!! Form::button(' ', ['class' => 'glyphicon glyphicon-remove btn btn-danger', 'type' => 'submit'])  !!}
                                    {!! Form::close() !!}
                                </li>
                                <li>
                                    {!! Form::open(['action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@restore', 'id' => $col->id ] ])  !!}
                                    {!! Form::button(' ', ['class' => 'glyphicon glyphicon-refresh btn btn-primary', 'type' => 'submit'])  !!}
                                    {!! Form::close() !!}
                                </li>
                            @else
                                <li>
                                    {!! Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirmBox("Are you sure to move to trash, '. $col->full_name .'?")', 'action' => ['\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@destroy', 'id' => $col->id ] ])  !!}
                                    {!! Form::button(' ', ['class' => 'glyphicon glyphicon-trash btn btn-danger', 'type' => 'submit'])  !!}
                                    {!! Form::close() !!}
                                </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach