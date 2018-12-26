<table class="table table-responsive" id="members-table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
        <th>Tipe</th>
        <th>Saldo</th>
        <th>No Hp</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($members as $member)
        <tr>
            <td>{!! $member->user->name !!}</td>
            <td>{!! $member->tanggal_lahir->format('d-m-Y') !!}</td>
            <td>{!! config('variable.tipe_member')[$member->tipe] !!}</td>
            <td>{!! $member->saldo !!}</td>
            <td>{!! $member->no_hp !!}</td>
            <td>
                {!! Form::open(['route' => ['members.destroy', $member->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('members.show', [$member->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('members.edit', [$member->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>