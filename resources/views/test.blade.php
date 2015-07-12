@extends('main', ['page_title' => 'File not found'])

@section('topbar')
    <article class="topbar_content test">
        <div class="title">This is topbar.</div>
    </article>
@endsection

@section('header')
    <article class="header_content test">
        <div class="title">This is header.</div>
    </article>
@endsection

@section('sb_left')
    <article class="sb_container  test">
        <div class="title">This is left sidebar.</div>
        <div class="btn-primary">test</div>
    </article>
@endsection

@section('contents')
    <article class="content_container  test">
        <div class="title">This is article.</div>
    </article>
@endsection

@section('sb_right')
    <article class="sb_container  test">
        <div class="title">This is right sidebar.</div>
    </article>
@endsection

@section('footer')
    <article class="footer_content test">
        <div class="title">This is footer.</div>
    </article>
@endsection
