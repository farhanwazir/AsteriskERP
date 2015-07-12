<thead>
    <tr class="table_header">
        @foreach($data as $head)
            <th {{ array_key_exists('class', $head)? 'class='. $head['class'] .'' : '' }}
                    {{ array_key_exists('colspan', $head)? 'colspan="'. $head['colspan'] .'"' : '' }}>{!! $head['value'] !!}</th>
        @endforeach
    </tr>
</thead>