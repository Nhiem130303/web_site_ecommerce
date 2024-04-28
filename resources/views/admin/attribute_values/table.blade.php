<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="attribute-values-table">
            <thead>
            <tr>
                <th>Attribute Id</th>
                <th>Value</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attributeValues as $attributeValue)
                <tr>
                    <td>{{ $attributeValue->attribute_id }}</td>
                    <td>{{ $attributeValue->value }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.attributeValues.destroy', $attributeValue->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.attributeValues.show', [$attributeValue->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.attributeValues.edit', [$attributeValue->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $attributeValues])
        </div>
    </div>
</div>
