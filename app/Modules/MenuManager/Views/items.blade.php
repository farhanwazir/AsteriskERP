@extends('main', ['page_title' => trans('MenuManager::module.name'), 'heading' => trans('MenuManager::module.name'), 'slogan' => trans('MenuManager::module.version')])

@section('contents')
    <div class="container">
        <h2>
            {!! trans('MenuManager::common.submenu.headings.list', ['menu_name' => $menu->title])  !!}
        </h2>
        <p>{!! trans('MenuManager::common.submenu.descriptions.list', ['menu_name' => $menu->title]) !!}</p>
        <ul class="nav navbar-left spacer">
            <li><a href="{{ action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@itemCreate', ['menu' => $menu->id]) }}" class="btn btn-primary">{!! trans('MenuManager::form.submenu.buttons.create') !!}</a></li>
        </ul>

        <?php
        $head = ['list_title' => ['value' => trans('MenuManager::labels.submenu.title'), 'class' => 'tbl-col-sm'],
                'method' => ['value' => trans('labels.method'), 'class' => 'tbl_col-sm'],
                'action' => ['value' => trans('labels.action'), 'class' => 'tbl-col-sm'],
                'description' => ['value' => trans('labels.description'), 'class' => 'tbl-col-lg'],
                'action_buttons' => ['value' => '', 'class' => 'tbl-col-sm-action']];
        $body = [];
        foreach($menu->items as $item){
            $index = count($body);
            foreach($head as $hkey => $title){
                switch($hkey){
                    case 'action_buttons':
                        $body[$index][$hkey] = '';

                        $body[$index][$hkey] .= '<div class="actoin-inline">';
                        $body[$index][$hkey] .= '<div class="actoin-inline"><a href="'. action("\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@itemEdit", ['menu' => $menu->id, 'item' => $item->id]) .'" data-toggle="tooltip" class="text-info" title="'. trans('MenuManager::form.submenu.buttons.titles.edit') .'"><span class="glyphicon glyphicon-edit"></span> </a></div>';
                        $body[$index][$hkey] .= Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirmBox("'. trans('MenuManager::form.submenu.msgbox.delete', ['item_name' => $item->title]) .'")', 'action' => ["\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@itemDestroy", $menu->id .'/'. $item->id ] ] );
                        $body[$index][$hkey] .= Form::button(' ', ['class' => 'glyphicon glyphicon-remove remove-btn-style', 'type' => 'submit']);
                        $body[$index][$hkey] .= Form::close();
                        $body[$index][$hkey] .= '</div>';
                    break;
                    default:
                    $body[$index][$hkey] = $item->$hkey;
                    break;
                }
    }
    }
    $tbl_contents['header'] = $head;
    $tbl_contents['body'] = $body;
    ?>

    @include('asterisk.components.grid.table', $tbl_contents)


    </div>
@endsection
