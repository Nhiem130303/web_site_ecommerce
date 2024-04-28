<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="product-inventories-table">
            <thead>
            <tr>
                <th>Product Id</th>
                <th>Location Id</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productInventories as $productInventory)
                <tr>
                    <td>{{ $productInventory->product->name }} - {{ $productInventory->productVariant->name }}</td>
                    <td>{{ $productInventory->location->name }}</td>
                    <td>{{ $productInventory->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $productInventories])
        </div>
    </div>
</div>
