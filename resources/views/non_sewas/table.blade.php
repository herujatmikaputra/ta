<table class="table table-responsive" id="nonSewas-table">
    <thead>
        <tr>
            <th>Nama</th>
        <th>Harga</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($nonSewas as $nonSewa)
        <tr>
            <td>{!! $nonSewa->nama !!}</td>
            <td>{!! $nonSewa->harga !!}</td>
            <td>
                {!! Form::open(['route' => ['nonSewas.destroy', $nonSewa->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
{{--                    <a href="{!! route('nonSewas.show', [$nonSewa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('nonSewas.edit', [$nonSewa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>