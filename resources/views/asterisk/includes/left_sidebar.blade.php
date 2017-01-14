{{-- Logged out user menu --}}
@if(!Auth::check())
    @section('left_sidebar')
        {{-- sidebar: style can be found in sidebar.less --}}
        <section class="sidebar">
            {{-- Search Form (Optional) --}}
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
                </div>
            </form>{{-- /.sidebar-form --}}
        </section>{{-- /.sidebar --}}
    @endsection
    <?php return false; ?>
@endif


{{-- Logged in user menu --}}
@section('left_sidebar')
    <section class="sidebar">
            <ul class="sidebar-menu">
                <li class="header">Discover Asterisk</li>

            <?php
            $menus = Menu::getRawMenusByLocation();
            foreach($menus as $menu){
                $inactive_panel_class = 'collapse';
                $active_panel = 'active active-current-panel';
                $panel = '<li class="treeview {active-panel} open">{title}
                <ul class="treeview-menu">';
                foreach($menu->items as $item){
                    $href_method = $item->method;
                    $href = $href_method($item->action);
                    $current = (Request::url() == $href);
                    if($current) $inactive_panel_class ='';
                    $panel .= '<li '. (($current)? 'class="active active-current-item"' : '') .'><a href="'. $href .'" > '. $item->title .' </a></li>';
                }
                $panel .= '</ul></li>';

                echo str_replace(array('{title}', '{active-panel}'),
                        (($inactive_panel_class == '')? array('<a href="#">'.$menu->list_title.' <i class="fa fa-angle-left pull-right"></i></a>', $active_panel) :
                                array('<a href="#">'. $menu->list_title .' <i class="fa fa-angle-left pull-right"></i></a>', '') ),
                        str_replace('{in-class}', $inactive_panel_class, $panel));

            }
            ?>
            </ul>


    </section>{{-- /.sidebar --}}
@endsection