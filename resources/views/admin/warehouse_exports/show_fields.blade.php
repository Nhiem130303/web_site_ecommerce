<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $warehouseExport->product_id }}</p>
</div>

<!-- Product Variant Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_variant_id', 'Product Variant Id:') !!}
    <p>{{ $warehouseExport->product_variant_id }}</p>
</div>

<!-- Location Id Field -->
<div class="col-sm-12">
    {!! Form::label('location_id', 'Location Id:') !!}
    <p>{{ $warehouseExport->location_id }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $warehouseExport->quantity }}</p>
</div>

<!-- Created By Id Field -->
<div class="col-sm-12">
    {!! Form::label('created_by_id', 'Created By Id:') !!}
    <p>{{ $warehouseExport->created_by_id }}</p>
</div>

