@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tambah Makanan/Minuman
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'simpanSewaNonLapangan']) !!}
                    <input type="hidden" name="transaksi_id" value="{!! $id !!}">

                    <div class="form-group col-sm-12">
                        <div>
                            <a class="btn btn-xs btn-primary" onclick="addMakanan()">+Makanan/Minuman</a>
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
    </script>
@endsection