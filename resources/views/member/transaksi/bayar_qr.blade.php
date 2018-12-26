@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bayar Transaksi QR Code
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <div class="form-group">
                        <label for="email_address" class="form-group" style="padding-left: 20px">Scan Barcode Disini</label>
                        <div class="form-group text-center">
                            <video id="preview" style="max-height: 400px;max-width: 400px;"></video>
                        </div>
                        {!! Form::open(['route' => 'bayar.qr']) !!}
                            <input type="hidden" class="member_id" name="member_id">
                            <input type="hidden" name="transaksi_id" value="{!! $transaksi->id !!}">
                        {!! Form::close() !!}
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
                $('.member_id').val(content);
                $('form').submit();
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