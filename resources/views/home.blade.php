@extends('layouts.app')

@section('content')
    @if(Auth::user()->role == 3)
        <div class="row" style="padding-left: 20px;">
            <div class="col-lg-3 col-xs-6">
                <h3>Hi!</h3>
                <h4>Selamat Datang!</h4>
                <h4>Sistem Informasi Garuda Futsal</h4>
            </div>
        </div>
    @else
        <div class="row" style="padding-left: 20px;padding-top: 20px;">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua-active">
                        <div class="inner">
                            <h3>{!! $member !!}</h3>

                            <p>Member Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green-active">
                        <div class="inner">
                            <h3>{!! $transaksi !!}</h3>

                            <p>Transaksi Belum Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-basket"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
@endsection
