<!-- Member Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('member_id', 'Member:') !!}
    {!! Form::select('member_id', $member, null, ['class' => 'form-control member']) !!}
</div>

<!-- Member Id Field -->
<div class="form-group col-sm-12 tipe">
    {!! Form::label('member_id', 'Tipe:') !!}
    {!! Form::select('tipe', config('variable.tipe_member'), null, ['class' => 'form-control']) !!}
</div>

<!-- Member Id Field -->
<div class="form-group col-sm-12 tipe">
    {!! Form::label('member_id', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Member Id Field -->
<div class="form-group col-sm-12 tipe">
    {!! Form::label('member_id', 'Nomor Handphone:') !!}
    {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    <h3>Tambah Item</h3>
    <div>
        <a class="btn btn-xs btn-primary" onclick="addSewaLapangan()">+Sewa Lapangan</a>
        <a class="btn btn-xs btn-primary" onclick="addMakanan()">+Makanan/Minuman</a>
    </div>
    <div class="target row" style="margin-top: 5px">

    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('transaksis.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script>
        var add;
        var dump;

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

        function addMakanan() {
            add = '<div class="parent">\n' +
                '            <div class="form-group col-sm-5">\n' +
                '                {!! Form::label("tanggal", "Makanan/Minuman:") !!}\n' +
                '                {!! Form::select("makanan[]", $nonSewa, null, ["class" => "form-control"]) !!}\n' +
                '            </div>\n' +
                '            <div class="form-group col-sm-5">\n' +
                '                {!! Form::label("tanggal", "Jumlah:") !!}\n' +
                '                {!! Form::number("jumlah[]", null, ["class" => "form-control","value"=>1]) !!}\n' +
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

        function tipe() {
            if($('.member option:selected').val() > 1){
                $('.tipe').hide();
            }else{
                $('.tipe').show();
            }
        }

        $(document).on('change','.member',function () {
          tipe()
        });

        // $('.tipe').hide();
    </script>
@endsection