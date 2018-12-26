@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Non Sewa
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'nonSewas.store']) !!}

                        @include('non_sewas.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
