<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak Nota Transaksi</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css') }}">
    <style>
        .borders{
            border: 2px solid black;
        }
    </style>

</head>

<body>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content">
            <h2 style="text-align: center">Cetak Nota Transaksi</h2>
            <!-- Tanggal Field -->
            <div class="form-group">
                {!! Form::label('tanggal', 'Tanggal:') !!}
                <p>{!! $transaksi->tanggal !!}</p>
            </div>

            <!-- Status Field -->
            <div class="form-group">
                {!! Form::label('status', 'Status:') !!}
                <p>{!! config('variable.status_booking')[$transaksi->status] !!}</p>
            </div>

            <div class="form-group">
                {!! Form::label('member_id', 'Konsumen:') !!}
                <p>
                    @if($transaksi->member->user_id > 2)
                        {!! $transaksi->member->user->name !!}
                    @else
                        {!! $transaksi->member->nama !!}
                    @endif
                </p>
            </div>

            <div class="form-group">
                {!! Form::label('member_id', 'Nomor Handphone:') !!}
                <p>
                    {!! $transaksi->member->no_hp !!}
                </p>
            </div>

            <!-- Pegawai Id Field -->
            <div class="form-group">
                {!! Form::label('pegawai_id', 'Pegawai:') !!}
                <p>
                    @isset($transaksi->pegawai_id)
                        {!! $transaksi->pegawai->name !!}
                    @endisset
                </p>
            </div>

            <div class="form-group">
                <h3>Daftar Transaksi</h3>
                <h4>Sewa Lapangan</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        {{--<th>Status</th>--}}
                        <th>Biaya Sewa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $no=1;$bayar=0;
                    @endphp
                    @forelse($transaksi->sewa($id) as $item)
                        <tr>
                            <td>{!! $no++ !!}</td>
                            <td>{!! $item->tanggal_booking !!}</td>
                            <td>{!! $item->sewa->jam_mulai !!}-{!! $item->sewa->jam_selesai !!}</td>
                            {{--<td>{!! config('variable.status_booking')[$item->status] !!}</td>--}}
                            <td>{!! $item->harga !!}</td>
                            @php $bayar += $item->harga;
                            @endphp
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Data belum ada</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <h4>Makanan/Minuman</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Item</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $no=1;
                    @endphp
                    @forelse($transaksi->nonSewa($id) as $item)
                        <tr>
                            <td>{!! $no++ !!}</td>
                            <td>{!! $item->nonSewa->nama !!}</td>
                            <td>{!! $item->jumlah !!}</td>
                            <td>{!! $item->harga !!}</td>
                            <td>{!! $item->harga*$item->jumlah !!}</td>
                            @php $bayar += $item->harga*$item->jumlah;
                            @endphp
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Data belum ada</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td><b>Total Transaksi</b></td>
                        <td colspan="3"></td>
                        <td><b>{!! $bayar !!}</b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jquery.min.js') }}"></script>
<script src="{{asset('js/bootstrap.min.js') }}"></script>
<script>
    window.print();
</script>
</body>
</html>