@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Transaksi
        </h1>
    </section>
    <div class="content">
        @if(Session::has('flash_succes'))
            <p class="alert alert-info">{{ Session::get('flash_succes') }}</p>
        @endif
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('transaksis.show_fields')
                    @if($transaksi->status != 3)
                        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Bayar Tunai</a>
                        <a type="button" class="btn btn-primary" href="{!! route('bayar',['id' => $id]) !!}">Bayar QR Code</a>
                    @endif
                    <a class="btn btn-primary" href="{!! route('printBon',['id' => $transaksi->id]) !!}">Print</a>
                    <a href="{!! route('transaksis.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
