<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $warehouseReceipt->product_id }}</p>
</div>

<!-- Product Variant Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_variant_id', 'Product Variant Id:') !!}
    <p>{{ $warehouseReceipt->product_variant_id }}</p>
</div>

<!-- Location Id Field -->
<div class="col-sm-12">
    {!! Form::label('location_id', 'Location Id:') !!}
    <p>{{ $warehouseReceipt->location_id }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $warehouseReceipt->quantity }}</p>
</div>

<!-- Created By Id Field -->
<div class="col-sm-12">
    {!! Form::label('created_by_id', 'Created By Id:') !!}
    <p>{{ $warehouseReceipt->created_by_id }}</p>
</div>

