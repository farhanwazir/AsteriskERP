@extends('main', ['page_title' => trans('MenuManager::module.name'), 'heading' => trans('MenuManager::module.name'), 'slogan' => trans('MenuManager::module.version')])


@section('contents')
    <div class="container">

        <h2>
            @if(isset($search_result) && $search_result)
                {!! trans('MenuManager::common.main.headings.search') !!}
            @else
                {!! trans('MenuManager::common.main.headings.list') !!}
            @endif
        </h2>
        <p>
            @if(isset($keyword) && isset($search_result) && $search_result)
                <strong>{!! trans('MenuManager::common.main.descriptions.search', ['keyword' => $keyword]) !!}</strong>
            @else
                {!! trans('MenuManager::common.main.descriptions.list') !!}</p>
            @endif
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav navbar-right nav-pills spacer">
                    @if(!isset($trashed) )
                        <li>
                            <div class="input-group spacer-right big-input suggestion-search">
                                <input type="text" id="search_input" class="typeahead form-control" value="{{$keyword or ''}}" placeholder="{!! trans('form.fields.search.input') !!}" autocomplete="off">
                                <span class="input-group-btn">
                                    <button class="btn btn-default search_btn_go" type="button">{!! trans('form.buttons.search') !!}</button>
                                </span>
                            </div>
                        </li>
                    @endif

                    @if((isset($trashed) && $trashed) || (isset($search_result) && $search_result) )
                        <li><a href="{{ action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@index') }}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> {!! trans('MenuManager::form.main.buttons.back_to') !!}</a></li>
                    @else
                        <li><a href="{{ action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@trashed') }}" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span> {!! trans('MenuManager::form.main.buttons.trash') !!}</a></li>
                    @endif

                </ul>
                @if(!isset($trashed))
                <ul class="nav navbar-left nav-pills spacer">
                    <li><a href="{{ action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@create') }}" class="btn btn-info">{!! trans('MenuManager::form.main.buttons.create') !!}</a></li>
                </ul>
                @endif
            </div>
        </div>

        <?php

            $head = ['list_title' => ['value' => trans('MenuManager::labels.main.title'), 'class' => 'tbl-col-sm'],
                    'slug' => ['value' => trans('labels.names.machine'), 'class' => 'tbl_col-sm'],
                    'location' => ['value' => trans('labels.location'), 'class' => 'tbl_col-sm'],
                    'description' => ['value' => trans('labels.description'), 'class' => 'tbl-col-lg'],
                    'no_of_items' => ['value' => trans('MenuManager::labels.main.submenu_items'), 'class' => 'tbl-col-sm'],
                    'action_buttons' => ['value' => '', 'class' => 'tbl-col-sm-action']];
            $body = [];
            foreach($menus as $menu){
                $index = count($body);
                //$body[$index]['aerp_data_row_class'] = 'aerp_clickable_row';
                //$body[$index]['aerp_data_row_data']['data-href'] = action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@show', ['id' => $menu->id] );
                foreach($head as $hkey => $title){
                    switch($hkey){
                        case 'action_buttons':
                            $body[$index][$hkey] = '';
                            if(!$menu->trashed()){
                                $body[$index][$hkey] .= '<div class="actoin-inline"><a href="'. action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@show', ['id' => $menu->id] ) .'" data-toggle="tooltip" class="text-success" title="'. trans('MenuManager::form.main.buttons.titles.add_items') .'"><span class="glyphicon glyphicon-plus"></span> </a></div>';

                                $body[$index][$hkey] .= '<div class="actoin-inline"><a href="'. action("\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@edit", ['id' => $menu->id]) .'" data-toggle="tooltip" class="text-info" title="'. trans('MenuManager::form.main.buttons.titles.edit') .'"><span class="glyphicon glyphicon-edit"></span> </a></div>';
                            }else{
                                $body[$index][$hkey] .= '<div class="actoin-inline"><a href="'. action("\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@restore", ['id' => $menu->id]) .'" data-toggle="tooltip" class="text-success" title="'. trans('MenuManager::form.main.buttons.titles.restore') .'"><span class="glyphicon glyphicon-refresh"></span> </a></div>';
                            }
                            $body[$index][$hkey] .= '<div class="actoin-inline">';
                            $body[$index][$hkey] .= Form::open(['method' => 'DELETE', 'onSubmit' => 'return confirmBox("'.($menu->trashed()? trans('MenuManager::form.main.msgbox.delete', ['menu_name' => $menu->title]) : trans('MenuManager::form.main.msgbox.trash', ['menu_name' => $menu->title])).'")', 'action' => [($menu->trashed()? "\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@removeTrashed" : "\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@destroy"), $menu->id] ] );
                            $body[$index][$hkey] .= Form::button(' ', ['class' => 'glyphicon glyphicon-remove remove-btn-style', 'type' => 'submit']);
                            $body[$index][$hkey] .= Form::close();
                            $body[$index][$hkey] .= '</div>';
                            break;
                        default:
                            $body[$index][$hkey] = ($hkey == 'no_of_items')? $menu->items->count() : $menu->$hkey;
                            break;
                    }
                }
            }
            $tbl_contents['header'] = $head;
            $tbl_contents['body'] = $body;
        ?>

        @include('asterisk.components.grid.table', $tbl_contents)
        {!! $menus->render() !!}
    </div>
@endsection


@section('page_script')

<script type="text/javascript">

    $(document).ready(function() {
        /*$(".aerp_clickable_row").click(function() {
            window.document.location = $(this).data("href");
        });*/
        var menu_suggestions = new Bloodhound({
            datumTokenizer: function (result) {
                return Bloodhound.tokenizers.whitespace(result.name);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: "<?php echo action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@menusMatchingJSON', ['tag' => '%tag']); ?>",
                filter: function (items) {

                    return $.map(items, function (item) {

                        return {
                            id: item.id,
                            name: item.title,
                            location: item.location
                        };
                    });
                },
                wildcard: "%tag"
            }
        });

// Initialize the Bloodhound suggestion engine
        menu_suggestions.initialize();
// Instantiate the Typeahead UI
        $('.typeahead').typeahead(null, {
            displayKey: 'name',
            source: menu_suggestions.ttAdapter(),
            templates: {
                suggestion: Handlebars.compile("<p style='padding:5px'><b>@{{name}}</b> - <small>Loc: @{{location}}</small></p>"),
                footer: Handlebars.compile("<div class='tt-footer '>Searched for <b>'@{{query}}'</b></div>")
            }
        }).bind('typeahead:selected', function(obj, item) {
            var iurl = "<?php echo action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@show'); ?>";
            window.document.location = iurl.replace("%7Bmenu%7D", item.id);
        });


        $('.search_btn_go').click(function(){
            var iurl = "<?php echo action('\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@search'); ?>";
            window.document.location = iurl.replace("%7Btag%7D", $('#search_input').val());
        });
    });



</script>
@endsection
