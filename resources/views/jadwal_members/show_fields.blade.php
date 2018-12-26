<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $jadwalMember->id !!}</p>
</div>

<!-- Hari Field -->
<div class="form-group">
    {!! Form::label('hari', 'Hari:') !!}
    <p>{!! $jadwalMember->hari !!}</p>
</div>

<!-- Waktu Field -->
<div class="form-group">
    {!! Form::label('waktu', 'Waktu:') !!}
    <p>{!! $jadwalMember->waktu !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $jadwalMember->user_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $jadwalMember->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $jadwalMember->updated_at !!}</p>
</div>

