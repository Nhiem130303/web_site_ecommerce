<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="warehouse-receipts-table">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số Lượng</th>
                <th>Người tạo</th>
                <th>Ngày tạo</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($warehouseReceipts as $warehouseReceipt)
                <tr>
                    <td>{{ $warehouseReceipt->product->name }} - {{$warehouseReceipt->productVariant->name}}</td>
                    <td>{{ $warehouseReceipt->quantity }}</td>
                    <td>{{ $warehouseReceipt->user->name }}</td>
                    <td>{{ $warehouseReceipt->created_at }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.warehouseReceipts.destroy', $warehouseReceipt->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.warehouseReceipts.show', [$warehouseReceipt->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.warehouseReceipts.edit', [$warehouseReceipt->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $warehouseReceipts])
        </div>
    </div>
</div>
