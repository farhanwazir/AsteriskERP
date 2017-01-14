@extends('main', ['page_title' => trans('PRM::module.name'), 'heading' => trans('PRM::module.name'), 'slogan' => trans('PRM::module.version')])


@section('contents')

    <div class="container">

        <h2>
            @if(isset($search_result) && $search_result)
                @lang('PRM::common.people.headings.search')
            @else
                @lang('PRM::common.people.headings.list')
            @endif
        </h2>
        <p>
            @if(isset($keyword) && isset($search_result) && $search_result)
                <strong>@lang('common.search.description', ['keyword' => $keyword])</strong>
            @else
                @lang('PRM::common.people.descriptions.list')</p>
            @endif
        <div class="row">
            <div class="col-sm-12">
                <ul class="nav navbar-right nav-pills spacer">
                    @if(!isset($trashed) )
                        <li>
                            <div class="input-group spacer-right big-input suggestion-search">
                                <input type="text" id="search_input" class="typeahead form-control" value="{{$keyword or ''}}" placeholder="@lang('form.fields.search.input')" autocomplete="off">
                                <span class="input-group-btn">
                                    <button class="btn btn-default search_btn_go" type="button">@lang('form.buttons.search')</button>
                                </span>
                            </div>
                        </li>
                    @endif

                    @if((isset($trashed) && $trashed) || (isset($search_result) && $search_result) )
                        <li><a href="{{ action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@index') }}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> {!! trans('PRM::form.people.buttons.back_to') !!}</a></li>
                    @else
                        <li><a href="{{ action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@trashed') }}" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span> {!! trans('PRM::form.people.buttons.trash') !!}</a></li>
                    @endif

                </ul>
                @if(!isset($trashed))
                    <ul class="nav navbar-left nav-pills spacer">
                        <li><a href="{{ action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@create') }}" class="btn btn-info">@lang('PRM::form.people.buttons.add')</a></li>
                    </ul>
                @endif
            </div>
        </div>
        <?php
        $tbl_contents['cols'] = 2;
        $tbl_contents['body'] = $items;
        isset($trashed)? $tbl_contents['trashed'] = $trashed : '';
        ?>
            @include('asterisk.components.grid.profiles', $tbl_contents)

        {!! $items->render() !!}
    </div>

@endsection

@section('page_script')

    <script type="text/javascript">

        $(document).ready(function() {
            /*$(".aerp_clickable_row").click(function() {
             window.document.location = $(this).data("href");
             });*/
            var people_suggestions = new Bloodhound({
                datumTokenizer: function (result) {
                    return Bloodhound.tokenizers.whitespace(result.name);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: "<?php echo action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@peopleMatchingJSON', ['tag' => '%tag']); ?>",
                    filter: function (items) {

                        return $.map(items, function (item) {

                            return {
                                id: item.id,
                                name: item.first_name +' '+ item.last_name,
                                father: item.father_name,
                                photo: item.photo,
                                country: item.country_code
                            };
                        });
                    },
                    wildcard: "%tag"
                }
            });

// Initialize the Bloodhound suggestion engine
            people_suggestions.initialize();
// Instantiate the Typeahead UI
            $('.typeahead').typeahead(null, {
                displayKey: 'name',
                source: people_suggestions.ttAdapter(),
                templates: {
                    suggestion: Handlebars.compile("<div class='suggestion-row'><div class='left-container'><img src='<?php echo url(Config::get('asterisk.prm.people.photo.path')."{{photo}}"); ?>' class='suggestion-list-thumb' /></div><div class='right-container'><b>@{{name}}</b> - <small>Loc: @{{country}}</small><span class='new-line'>@{{father}}</span></div></div>"),
                    footer: Handlebars.compile("<div class='tt-footer '>Searched for <b>'@{{query}}'</b></div>")
                }
            }).bind('typeahead:selected', function(obj, item) {
                var iurl = "<?php echo action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@show'); ?>";
                window.document.location = iurl.replace("%7Bpeoples%7D", item.id);
            });


            $('.search_btn_go').click(function(){
                var iurl = "<?php echo action('\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@search'); ?>";
                window.document.location = iurl.replace("%7Btag%7D", $('#search_input').val());
            });
        });



    </script>
@endsection