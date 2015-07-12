<tfoot>
<tr class="table_footer">
    @foreach($data as $foot)
        <td {{ array_key_exists('class', $head)? 'class="'. $head['class'] .'"' : '' }}
                {{ array_key_exists('colspan', $head)? 'colspan="'. $head['colspan'] .'"' : '' }}>{!! $foot['value'] !!}</td>
    @endforeach
</tr>
</tfoot>