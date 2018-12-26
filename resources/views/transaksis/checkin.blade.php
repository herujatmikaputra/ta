@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Check In Lapangan
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <div class="form-group">
                        <label for="email_address" class="form-group" style="padding-left: 20px">Scan QR code Disini</label>
                        <div class="form-group text-center">
                            <video id="preview" style="max-height: 400px;max-width: 400px;"></video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{!! asset('js/instascan.min.js') !!}"></script>
    <script>
        initCam();
        function initCam() {
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
            scanner.addListener('scan', function (content) {
                var cari = "{!! url('checkTransaksi') !!}";
                $.ajax({
                    type: 'GET',
                    url: cari+'/'+content,
                    data: {

                    },
                    success: function(data) {
                        if (data == "ok"){
                            window.location = "{!! route('transaksis.show',['id' => '']) !!}/"+content;
                        }else{
                            alert("Transaksi tidak ditemukan");
                        }
                    }
                });
            });

            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
            });
        }
    </script>
@endsection