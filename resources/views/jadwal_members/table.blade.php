<table class="table table-responsive" id="jadwalMembers-table">
    <thead>
        <tr>
            <th>Hari</th>
        <th>Waktu</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($jadwalMembers as $jadwalMember)
        <tr>
            <td>{!! $jadwalMember->hari !!}</td>
            <td>{!! $jadwalMember->waktu !!}</td>
            <td>{!! $jadwalMember->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['jadwalMembers.destroy', $jadwalMember->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('jadwalMembers.show', [$jadwalMember->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('jadwalMembers.edit', [$jadwalMember->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>