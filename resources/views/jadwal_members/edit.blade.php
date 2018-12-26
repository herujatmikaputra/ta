@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Jadwal Member
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($jadwalMember, ['route' => ['jadwalMembers.update', $jadwalMember->id], 'method' => 'patch']) !!}

                        @include('jadwal_members.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection