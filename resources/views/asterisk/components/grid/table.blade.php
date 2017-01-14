<table class="table table-striped table-bordered table-hover">
    @if(isset($header))
        @include('asterisk.components.grid.includes.tblheader', ['data' => $header])
    @endif

    @if(isset($footer))
        @include('asterisk.components.grid.includes.tblfooter', ['data' => $footer])
    @endif

    <tbody>
    @if(isset($body))

        @foreach($body as $row)
            <?php
            $row_class = (array_key_exists('aerp_data_row_class', $row)? 'class='. $row['aerp_data_row_class'] : '');
            $row_data_attr = ' ';
            if(array_key_exists('aerp_data_row_data', $row))
                foreach($row['aerp_data_row_data'] as $attr_name => $attr_val) $row_data_attr .= $attr_name .'='. $attr_val ;
            ?>
            @if(isset($header))
                <tr {{ $row_class }} {{ $row_data_attr }}>
                    @foreach($header as $name => $title)
                        <td>{!! (getType($row) == 'object')? $row->$name : $row[$name] !!}</td>
                    @endforeach
                </tr>
            @else
                <tr>
                    @foreach($row as $col)
                        <td>{!! $col; !!}</td>
                    @endforeach
                </tr>
            @endif

        @endforeach
    @else

        <tr>
            <td> <div class="alert-warning">No Record Found</div></td>
        </tr>

    @endif
    </tbody>
</table>
