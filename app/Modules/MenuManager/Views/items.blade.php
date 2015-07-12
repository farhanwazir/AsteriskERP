@extends('main')
@include('asterisk.includes.header')

@section('contents')
    <div class="container">

        <h2>
            <strong>Menu:</strong> {{ $menu->title }}
            @if(! empty($menu->location) )
                <small>({{ $menu->location }})</small>
            @endif

        </h2>
        <p>Below listed are ({{ $menu->title }}) menu items.</p>
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Item</th>
                <th>Method</th>
                <th>Action</th>
                <th>Description</th>
            </tr>
            </thead>

            <tbody>
            @foreach($menu->items as $item)
                <tr>
                    <td>
                        {{ $item->title }}
                    </td>
                    <td>
                        {{ $item->method }}
                    </td>
                    <td>
                        {{ $item->action }}
                    </td>
                    <td>
                        {{ $item->description }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
            </tr>
            </tbody>

        </table>
    </div>
@endsection
