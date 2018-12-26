<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Nama:') !!}
    <p>{!! $member->user->name !!}</p>
</div>

<!-- Tanggal Lahir Field -->
<div class="form-group">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    <p>{!! $member->tanggal_lahir->format('d-m-Y') !!}</p>
</div>

<!-- Tipe Field -->
<div class="form-group">
    {!! Form::label('tipe', 'Tipe:') !!}
    <p>{!! config('variable.tipe_member')[$member->tipe] !!}</p>
</div>

<!-- Saldo Field -->
<div class="form-group">
    {!! Form::label('saldo', 'Saldo:') !!}
    <p>{!! $member->saldo !!}</p>
</div>

<!-- No Hp Field -->
<div class="form-group">
    {!! Form::label('no_hp', 'No Hp:') !!}
    <p>{!! $member->no_hp !!}</p>
</div>

<!-- No Hp Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('jadwal', 'Jadwal:') !!}--}}
    {{--<p>--}}
        {{--@foreach($member->jadwalMember as $item)--}}
            {{--{!! config('variable.hari')[$item->jadwal->hari] !!} ({!! $item->jadwal->jam_mulai !!} - {!! $item->jadwal->jam_selesai !!})<br>--}}
        {{--@endforeach--}}
    {{--</p>--}}
{{--</div>--}}

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Tanggal Terdaftar:') !!}
    <p>{!! $member->created_at->format('d-m-Y') !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Masa Berlaku:') !!}
    <p>{!! $member->masa_berlaku->format('d-m-Y') !!}</p>
</div>

<div class="form-group">
    <h1 class="pull-left">Riwayat Saldo<br>
        <a class="btn btn-primary" style="margin-bottom: 5px" href="{!! route('riwayatSaldos.creates',['id'=>$member->id]) !!}">Tambah Saldo</a>
    </h1>
    <table class="table table-responsive" id="riwayatSaldos-table">
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Saldo Sekarang</th>
            <th>Saldo</th>
            <th>Tipe</th>
        </tr>
        </thead>
        <tbody>
        @foreach($member->riwayatSaldos as $riwayatSaldo)
            <tr>
                <td>{!! $riwayatSaldo->tanggal->format('d-m-Y') !!}</td>
                <td>{!! $riwayatSaldo->saldo_sekarang !!}</td>
                <td>{!! $riwayatSaldo->saldo !!}</td>
                <td>{!! config('variable.tipe_saldo')[$riwayatSaldo->tipe] !!}</td>
                {{--<td>--}}
                    {{--{!! Form::open(['route' => ['riwayatSaldos.destroy', $riwayatSaldo->id], 'method' => 'delete']) !!}--}}
                    {{--<div class='btn-group'>--}}
                        {{--<a href="{!! route('riwayatSaldos.show', [$riwayatSaldo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                        {{--<a href="{!! route('riwayatSaldos.edit', [$riwayatSaldo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                        {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                    {{--</div>--}}
                    {{--{!! Form::close() !!}--}}
                {{--</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

