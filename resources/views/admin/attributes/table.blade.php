<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="attributes-table">
            <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->code }}</td>
                    <td>{{ $attribute->name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.attributes.destroy', $attribute->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.attributes.show', [$attribute->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.attributes.edit', [$attribute->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $attributes])
        </div>
    </div>
</div>
