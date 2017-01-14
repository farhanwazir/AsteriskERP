<footer class="main-footer">
    @if (isset($__env->getSections()['footer']))
        @yield('footer')
    @else
        <div class="pull-right hidden-xs">
            {!! trans('common.version') !!}
        </div>
        {!! trans('common.copyrights') !!}
    @endif
</footer>


