<div class="form-group col-sm-12">
    {!! Form::label('tipe', 'Sumber Data:') !!}
    {!! Form::select('sumber_data', ['Silahkan Pilih','Manual Input','Dari Data User'], null,
    ['class' => 'form-control sumber', 'onchange' => 'changeInput()']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6 manual">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6 manual">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6 manual">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6 manual">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', config('variable.status_user'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 user">
    {!! Form::label('tipe', 'User:') !!}
    {!! Form::select('user_id', $user, null, ['class' => 'form-control users']) !!}
</div>

<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6 all">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::date('tanggal_lahir', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Tipe Field -->
<div class="form-group col-sm-6 all">
    {!! Form::label('tipe', 'Tipe:') !!}
    {!! Form::select('tipe', config('variable.tipe_member'),null, ['class' => 'form-control']) !!}
</div>

<!-- Saldo Field -->
<div class="form-group col-sm-6 all">
    {!! Form::label('saldo', 'Saldo:') !!}
    {!! Form::number('saldo', null, ['class' => 'form-control']) !!}
</div>

<!-- No Hp Field -->
<div class="form-group col-sm-6 all">
    {!! Form::label('no_hp', 'No Hp:') !!}
    {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6 all">
    {!! Form::label('no_hp', 'Masa Berlaku:') !!}
    {!! Form::date('masa_berlaku', null, ['class' => 'form-control']) !!}
</div>

{{--<!-- Tipe Field -->--}}
{{--<div class="form-group col-sm-12 all">--}}
    {{--{!! Form::label('tipe', 'Jadwal:') !!}--}}
    {{--{!! Form::select('jadwal_id[]', $jadwal,null, ['class' => 'form-control']) !!}--}}
    {{--<a href="#" onclick="add()">Add</a>--}}
    {{--<div class="targets">--}}

    {{--</div>--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12 all">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('members.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script>
        $(function () {
            $('.user').hide();
            $('.manual').hide();
            $('.all').hide();
            $('.users').attr("disabled","disabled");
            @isset($member)
                $('.user').show();
                $('.all').show();
            @endisset
        });

        function changeInput() {
            var opsi = $('.sumber option:selected').val();
            $('.user').hide();
            $('.manual').hide();
            $('.all').hide();
            if (opsi == 1){
                $('.manual').show();
                $('.users').attr("disabled","disabled");
                $('.all').show();
            }else if(opsi == 2){
                $('.user').show();
                $('.all').show();
                $('.users').removeAttr("disabled");
                // $('.users').enable();
            }
        }

        {{--function add() {--}}
            {{--var add = '        <div class="parent">\n' +--}}
                {{--'            {!! Form::select('jadwal_id[]', $jadwal,null, ['class' => 'form-control']) !!}\n' +--}}
                {{--'            <a href="#" onclick="add()">Add</a> / <a href="#" onclick="remove($(this))">Remove</a>\n' +--}}
                {{--'        </div>';--}}
            {{--$('.targets').append(add);--}}
        {{--}--}}

        function remove(id) {
            id.parents('.parent').remove();
        }
    </script>
@endsection