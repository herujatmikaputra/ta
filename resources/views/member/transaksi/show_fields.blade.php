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

<!-- Member Id Field -->
<div class="form-group">
    {!! Form::label('member_id', 'Konsumen:') !!}
    <p>{!! $transaksi->member->user->name !!}</p>
</div>

<!-- Pegawai Id Field -->
<div class="form-group">
    {!! Form::label('pegawai_id', 'Pegawai:') !!}
    <p>
        @isset($transaksi->pegawai->name)
            {!! $transaksi->pegawai->name !!}
        @endisset
    </p>
</div>

{{--<div class="form-group">--}}
    {{--<a href="#" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>--}}
{{--</div>--}}

<div class="form-group">
    <h3>Daftar Transaksi</h3>
    <div class="form-group">
        @if($transaksi->status < 3)
            <a href="{!! route('addSewaLapangan',['id'=>$id]) !!}" class="btn btn-primary">+ Sewa Lapangan</a>
        @endif
    </div>
    <h4>Sewa Lapangan</h4>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Shift</th>
            <th>Status</th>
            <th>Biaya Sewa</th>
            <th>Aksi</th>
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
                    <td>{!! $item->status !!}</td>
                    <td>{!! $item->harga !!}</td>
                    @php $bayar += $item->harga;
                    @endphp
                    <td>
                        @if($transaksi->status < 3)
                            <a class="btn btn-xs btn-danger" href="{!! route('hapusSewa',['id' => $item->id]) !!}">Hapus</a>
                        @else
                            <a class="btn btn-xs btn-danger disabled" href="">Hapus</a>
                        @endif
                    </td>
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
            <th>Aksi</th>
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
                <td><a class="btn btn-xs btn-primary" href="{!! route('editNonSewa',['id' => $item->id]) !!}">Edit</a> <a class="btn btn-xs btn-danger" href="{!! route('hapusSewa',['id' => $item->id]) !!}">Hapus</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Data belum ada</td>
            </tr>
        @endforelse
        <tr>
            <td><b>Total Transaksi</b></td>
            <td colspan="3"></td>
            <td><b>{!! $bayar !!}</b></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    {!! Form::open(['route' => 'transaksis.tunai','id' => 'form']) !!}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Masukan Jumlah Uang</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" value="{!! $id !!}">
                    <div class="form-group col-sm-12">
                        {!! Form::label('hari', 'Jumlah Bayar:') !!}
                        {!! Form::text('jumlah', null, ['class' => 'form-control','disabled','placeholder' => $bayar]) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('hari', 'Bayar') !!}
                        {!! Form::text('bayar', null, ['class' => 'form-control bayar','onkeyup' => 'tunai()']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('hari', 'Kembalian:') !!}
                        {!! Form::text('jumlah', null, ['class' => 'form-control jumlah','disabled','placeholder' => 0]) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary send" disabled onclick="$('#form').submit();">Kirim</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@section('scripts')
    <script>
        var bayars  = {!! $bayar !!};
        var b = 0;

        function tunai() {
            b = $('.bayar').val();
            if (b >= bayars){
                $('.send').prop("disabled", false);
                $('.jumlah').val(b-bayars);
            }else{
                $('.jumlah').val(0);
                $('.send').attr("disabled", true);
            }
        }
    </script>
@endsection
