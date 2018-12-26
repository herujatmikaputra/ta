<!-- Saldo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('saldo', 'Saldo:') !!}
    {!! Form::number('saldo', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipe', 'Tipe:') !!}
    {!! Form::select('tipe', config('variable.tipe_saldo'), null, ['class' => 'form-control']) !!}
</div>

<input type="hidden" name="user_id" value="{!! $id !!}">

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('riwayatSaldos.index') !!}" class="btn btn-default">Cancel</a>
</div>
