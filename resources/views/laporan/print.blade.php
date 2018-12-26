<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Bulanan</title>
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
            <div class="row">
                <div class="col-sm-12">
                    <table style="width: 100vw">
                        <tr>
                            <td colspan="4"><h4 style="text-align: center">LAPORAN SURAT BULAN {!! strtoupper(config('value.bulan')[$bulan]) !!}</h4></td>
                        </tr>
                        <tr>
                            <th class="text-center borders">No</th>
                            <th class="text-center borders">Tanggal</th>
                            <th class="text-center borders">Pelanggan</th>
                            <th class="text-center borders">Total Transaksi</th>
                        </tr>
                        @php $no = 1;$totals=0;
                        @endphp
                        @forelse($transaksis as $transaksi)
                            <tr>
                                <td class="text-center borders">{!! $no++ !!}</td>
                                <td class="text-center borders">{!! $transaksi->tanggal->format('d-m-Y') !!}</td>
                                <td class="text-center borders">
                                    @if($transaksi->member->user_id != 2)
                                        {!! $transaksi->member->user->name !!}
                                    @else
                                        {!! $transaksi->member->nama !!}
                                    @endif
                                </td>
                                @php
                                    $total = 0;
                                    foreach ($transaksi->detail($transaksi->id) as $item){
                                        if ($item->jumlah == 0){
                                            $total += $item->harga;
                                        }else{
                                            $total += $item->harga * $item->jumlah;
                                        }
                                    }
                                   $totals += $total;
                                @endphp
                                <td class="text-center borders">{!! $total !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center borders">Data belum ada</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td class="text-center borders"><b>Total</b></td>
                            <td colspan="2" class="borders"></td>
                            <td class="text-center borders">{!! $totals !!}</td>
                        </tr>
                    </table>
                </div>
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