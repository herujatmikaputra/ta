@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tambah Sewa Lapangan
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'simpanSewaLapangan']) !!}
                    <input type="hidden" name="transaksi_id" value="{!! $id !!}">

                    <div class="form-group col-sm-12">
                        <div>
                            <a class="btn btn-xs btn-primary" onclick="addSewaLapangan()">+Sewa Lapangan</a>
                        </div>
                        <div class="target row" style="margin-top: 5px">

                        </div>
                    </div>

                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('transaksis.show',['id'=>$id]) !!}" class="btn btn-default">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var add;

        function addSewaLapangan() {
            add = '<div class="parent">\n' +
                '            <div class="form-group col-sm-5">\n' +
                '                {!! Form::label("tanggal", "Tanggal Booking:") !!}\n' +
                '                {!! Form::date("tanggal_booking[]", null, ["class" => "form-control", "onchange" => "getJadwal($(this))"]) !!}\n' +
                '            </div>\n' +
                '            <div class="form-group col-sm-5">\n' +
                '                {!! Form::label("tanggal", "Jam Booking:") !!}\n' +
                '                <select class="form-control jadwal" name="sewa_id[]"><option>Silahkan pilih dulu tanggal</option></select>\n' +
                '            </div>\n' +
                '            <div class="form-group col-sm-1">\n' +
                '                <a class="btn btn-danger" onclick="remove($(this))" style="margin-top: 23px">Hapus</a>\n' +
                '            </div>\n' +
                '        </div>';
            $('.target').append(add);
        }

        function remove(a) {
            a.parents('.parent').remove()
        }

        function getJadwal(a) {
            var cari = "{!! url('getJadwal') !!}";
            $.ajax({
                type: 'GET',
                url: cari+'/'+a.val(),
                data: {

                },
                success: function(data) {
                    console.log(data)
                    a.parents('.parent').find('.jadwal').html('');
                    if (data.length > 0){
                        for(var i in data){
                            a.parents('.parent').find('.jadwal').append('<option value="'+data[i].id+'">'+data[i].jam+'</option>')
                        }
                    } else{
                        a.parents('.parent').find('.jadwal').append('<option value="">Tidak ada jadwal tersedia</option>')
                    }
                }
            });
        }
    </script>
@endsection