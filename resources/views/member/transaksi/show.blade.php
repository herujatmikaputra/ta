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
                    @include('member.transaksi.show_fields')
                    @if($transaksi->status < 3)
                        <a type="button" class="btn btn-primary" href="{!! route('member.bayar',['id' => $id]) !!}">Bayar</a>
                        <a type="button" class="btn btn-danger" href="{!! route('member.tolak',['id' => $id]) !!}">Batal</a>
                    @endif
                    <a href="{!! route('transaksi.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
