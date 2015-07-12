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

            @if(isset($header))
                <tr>
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
