@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Member
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <!-- User Id Field -->
                    <div class="form-group">
                        {!! Form::label('user_id', 'Nama:') !!}
                        <p>{!! $member->user->name !!}</p>
                    </div>

                    <!-- Tanggal Lahir Field -->
                    <div class="form-group">
                        {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
                        <p>{!! $member->tanggal_lahir->format('d-m-Y') !!}</p>
                    </div>

                    <!-- Tipe Field -->
                    <div class="form-group">
                        {!! Form::label('tipe', 'Tipe:') !!}
                        <p>{!! config('variable.tipe_member')[$member->tipe] !!}</p>
                    </div>

                    <!-- Saldo Field -->
                    <div class="form-group">
                        {!! Form::label('saldo', 'Saldo:') !!}
                        <p>{!! $member->saldo !!}</p>
                    </div>

                    <!-- No Hp Field -->
                    <div class="form-group">
                        {!! Form::label('no_hp', 'No Hp:') !!}
                        <p>{!! $member->no_hp !!}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('created_at', 'Tanggal Terdaftar:') !!}
                        <p>{!! $member->created_at->format('d-m-Y') !!}</p>
                    </div>

                    <!-- Created At Field -->
                    <div class="form-group">
                        {!! Form::label('created_at', 'Masa Berlaku:') !!}
                        <p>{!! $member->masa_berlaku->format('d-m-Y') !!}</p>
                    </div>

                    <div class="form-group">
                        <h1 class="pull-left">Riwayat Saldo<br>
                        </h1>
                        <table class="table table-responsive" id="riwayatSaldos-table">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Saldo Sekarang</th>
                                <th>Saldo</th>
                                <th>Tipe</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($member->riwayatSaldos as $riwayatSaldo)
                                <tr>
                                    <td>{!! $riwayatSaldo->tanggal->format('d-m-Y') !!}</td>
                                    <td>{!! $riwayatSaldo->saldo_sekarang !!}</td>
                                    <td>{!! $riwayatSaldo->saldo !!}</td>
                                    <td>{!! config('variable.tipe_saldo')[$riwayatSaldo->tipe] !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
