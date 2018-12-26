@extends('layouts.app')

@section('content')
    {!! csrf_field() !!}
    <section class="content-header">
        <h1 class="pull-left">Laporan Per Bulan</h1>
        <h1 class="pull-right">
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-2">
                        <label>Filter</label>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Bulan</label>
                                {{ Form::select('bulan',config('variable.bulan'), null, ['class' => 'form-control bulan'])}}
                            </div>
                            <div class="col-sm-12">
                                <label>Tahun</label>
                                {{ Form::select('tahun',$years, null, ['class' => 'form-control tahun'])}}
                            </div>
                            <div class="col-sm-12">
                                <a class="btn btn-primary" style="margin-top: 15px" onclick="refresh()">Tampilkan</a><br>
                                <div style="margin-top: 10px;display: none" class="print">
                                    <a class="print btn btn-primary" onclick="printLaporan()">Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <h3>Laporan Bulanan</h3>
                        <table class="table table-responsive" id="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Total Transaksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
@section('css')
    <link href="{{asset('datatables/datatables.css')}}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{asset('datatables/datatables.js')}}"></script>
    <script>
        var table;
        var print;
        
        $(document).ready(function(){
            table = $('#table').DataTable({
                responsive: true,
                columns:[
                    {data : 'no'},
                    {data : 'tanggal'},
                    {data : 'pelanggan'},
                    {data : 'total'}
                ]
            });
        });

        function refresh() {
            $('.print').hide();
            var url = "{!! url('getLaporan') !!}";
            var a = $('.bulan :selected').val();
            var b = $('.tahun :selected').val();
            if (a == '' || b == ''){
                alert('Mohon dipilih bulan dan tahun');
                return false;
            }
            url = url+'/'+a+'/'+b;
            print = "{!! url('print/laporan') !!}";
            // console.log(urlKeluar);
            table.ajax.url(url).load();
            console.log(url);
            print += '/'+a+'/'+b;
            $('.print').show();
        }

        function printLaporan() {
            window.open(print,'_blank');
        }

    </script>
@endsection