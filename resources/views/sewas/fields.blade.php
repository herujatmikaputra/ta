<!-- Hari Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hari', 'Hari:') !!}
    {!! Form::select('hari', config('variable.hari'), null, ['class' => 'form-control']) !!}
</div>

<!-- Jam Mulai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jam_mulai', 'Jam Mulai:') !!}
    {!! Form::text('jam_mulai', null, ['class' => 'form-control', 'placeholder' => 'Format 22:00']) !!}
</div>

<!-- Jam Selesai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jam_selesai', 'Jam Selesai:') !!}
    {!! Form::text('jam_selesai', null, ['class' => 'form-control', 'placeholder' => 'Format 22:00']) !!}
</div>

<!-- Member Pelajar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_pelajar', 'Harga Pelajar (Member):') !!}
    {!! Form::number('member_pelajar', null, ['class' => 'form-control']) !!}
</div>

<!-- Member Dewasa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('member_dewasa', 'Harga Dewasa (Member):') !!}
    {!! Form::number('member_dewasa', null, ['class' => 'form-control']) !!}
</div>

<!-- Non Pelajar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('non_pelajar', 'Harga Pelajar (Non Member):') !!}
    {!! Form::number('non_pelajar', null, ['class' => 'form-control']) !!}
</div>

<!-- Non Dewasa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('non_dewasa', 'Harga Dewasa (Non Member):') !!}
    {!! Form::number('non_dewasa', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sewas.index') !!}" class="btn btn-default">Cancel</a>
</div>
