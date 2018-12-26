@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Transaksi
        </h1>
    </section>
    <div class="content">

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($detail, ['route' => ['saveNonSewa', $detail->id], 'method' => 'patch']) !!}

                    <!-- Hari Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('hari', 'Makanan/Minuman:') !!}
                            {!! Form::select('non_sewa_id', $nonSewa, null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Waktu Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('waktu', 'jumlah:') !!}
                            {!! Form::text('jumlah', null, ['class' => 'form-control']) !!}
                        </div>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! url()->previous() !!}" class="btn btn-default">Cancel</a>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection