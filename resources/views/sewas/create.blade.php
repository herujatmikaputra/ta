@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Jadwal Sewa
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'sewas.store']) !!}

                        @include('sewas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
