<table class="table table-responsive" id="riwayatSaldos-table">
    <thead>
        <tr>
            <th>User Id</th>
        <th>Tanggal</th>
        <th>Saldo</th>
        <th>Tipe</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($riwayatSaldos as $riwayatSaldo)
        <tr>
            <td>{!! $riwayatSaldo->user_id !!}</td>
            <td>{!! $riwayatSaldo->tanggal !!}</td>
            <td>{!! $riwayatSaldo->saldo !!}</td>
            <td>{!! $riwayatSaldo->tipe !!}</td>
            <td>
                {!! Form::open(['route' => ['riwayatSaldos.destroy', $riwayatSaldo->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('riwayatSaldos.show', [$riwayatSaldo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('riwayatSaldos.edit', [$riwayatSaldo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>