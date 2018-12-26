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
                <div class="row">
                    {!! Form::open(['route' => 'transaksis.store']) !!}

                        @include('transaksis.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
