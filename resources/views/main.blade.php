@extends('ideator.main', isset($page_title)? ['page_title' => $page_title] :[] )

@section('body')

    @include('includes.header')

    @if (isset($__env->getSections()['sb_left']))
        <section class="sb_left">
            @yield('sb_left')
        </section>
    @endif

    @if (isset($__env->getSections()['contents']))
        <section id="contents_container" class="contents">
            @yield('contents')
        </section>
    @endif

    @if (isset($__env->getSections()['sb_right']))
        <section class="sb_right">
            @yield('sb_right')
        </section>
    @endif

    @include('includes.footer')

@endsection