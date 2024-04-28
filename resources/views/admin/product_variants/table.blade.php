<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="product-variants-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Plv 1</th>
                <th>Plv 2</th>
                <th>Plv 3</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productVariants as $productVariant)
                <tr>
                    <td>{{ $productVariant->name }}</td>
                    <td>{{ $productVariant->plv_1 }}</td>
                    <td>{{ $productVariant->plv_2 }}</td>
                    <td>{{ $productVariant->plv_3 }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.productVariants.destroy', $productVariant->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.productVariants.show', [$productVariant->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.productVariants.edit', [$productVariant->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $productVariants])
        </div>
    </div>
</div>
