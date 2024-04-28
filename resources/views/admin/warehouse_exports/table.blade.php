<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="warehouse-exports-table">
            <thead>
            <tr>
                <th>Product Id</th>
                <th>Product Variant Id</th>
                <th>Location Id</th>
                <th>Quantity</th>
                <th>Created By Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($warehouseExports as $warehouseExport)
                <tr>
                    <td>{{ $warehouseExport->product_id }}</td>
                    <td>{{ $warehouseExport->product_variant_id }}</td>
                    <td>{{ $warehouseExport->location_id }}</td>
                    <td>{{ $warehouseExport->quantity }}</td>
                    <td>{{ $warehouseExport->created_by_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.warehouseExports.destroy', $warehouseExport->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.warehouseExports.show', [$warehouseExport->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.warehouseExports.edit', [$warehouseExport->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $warehouseExports])
        </div>
    </div>
</div>
