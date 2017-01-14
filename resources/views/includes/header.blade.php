<header class="main-header">
    @include('asterisk.includes.top_nav')
    @if (isset($__env->getSections()['header']))
        <section id="header_container" class="header">
            @yield('header')
        </section>
    @endif


</header>

{{-- Left sidebar contents, it must be outside header tag --}}
@include('asterisk.includes.left_sidebar')
