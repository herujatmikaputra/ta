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
                   {!! Form::model($sewa, ['route' => ['sewas.update', $sewa->id], 'method' => 'patch']) !!}

                        @include('sewas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection