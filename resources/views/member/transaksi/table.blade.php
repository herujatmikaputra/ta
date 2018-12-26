<table class="table table-responsive" id="transaksis-table">
    <thead>
        <tr>
            <th>Tanggal</th>
        <th>Status</th>
        <th>Member</th>
        <th>Pegawai</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transaksis as $transaksi)
        <tr>
            <td>{!! $transaksi->tanggal !!}</td>
            <td>{!! config('variable.status_booking')[$transaksi->status] !!}</td>
            <td>{!! $transaksi->member->user->name !!}</td>
            <td>
                @isset($transaksi->pegawai  )
                    {!! $transaksi->pegawai->name !!}
                @endisset
            </td>
            <td>
                {!! Form::open(['route' => ['transaksi.destroy', $transaksi->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('transaksi.show', [$transaksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {{--<a href="{!! route('transaksi.edit', [$transaksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>