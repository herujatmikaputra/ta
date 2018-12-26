<table class="table table-responsive" id="sewas-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Hari</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Member Pelajar</th>
            <th>Member Dewasa</th>
            <th>Non Pelajar</th>
            <th>Non Dewasa</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php $no=1;
    @endphp
    @foreach($sewas as $sewa)
        <tr>
            <td>{!! $no++ !!}</td>
            <td>{!! config('variable.hari')[$sewa->hari] !!}</td>
            <td>{!! $sewa->jam_mulai !!}</td>
            <td>{!! $sewa->jam_selesai !!}</td>
            <td>{!! $sewa->member_pelajar !!}</td>
            <td>{!! $sewa->member_dewasa !!}</td>
            <td>{!! $sewa->non_pelajar !!}</td>
            <td>{!! $sewa->non_dewasa !!}</td>
            <td>
                {!! Form::open(['route' => ['sewas.destroy', $sewa->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('sewas.show', [$sewa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('sewas.edit', [$sewa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>