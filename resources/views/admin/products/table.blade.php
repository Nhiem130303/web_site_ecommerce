<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="products-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{route('file.show', $product->images->first()->file_id ?? '')}}" width="125" alt=""></td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ numberFormat($product->plv1) }} - {{ numberFormat($product->plv3)}}</td>
                    <td>{{ $product->status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['admin.products.destroy', $product->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('admin.products.show', [$product->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.products.edit', [$product->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $products])
        </div>
    </div>
</div>
