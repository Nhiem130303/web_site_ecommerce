<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $productInventory->product_id }}</p>
</div>

<!-- Product Variant Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_variant_id', 'Product Variant Id:') !!}
    <p>{{ $productInventory->product_variant_id }}</p>
</div>

<!-- Location Id Field -->
<div class="col-sm-12">
    {!! Form::label('location_id', 'Location Id:') !!}
    <p>{{ $productInventory->location_id }}</p>
</div>

<!-- Group Field -->
<div class="col-sm-12">
    {!! Form::label('group', 'Group:') !!}
    <p>{{ $productInventory->group }}</p>
</div>

<!-- Line Field -->
<div class="col-sm-12">
    {!! Form::label('line', 'Line:') !!}
    <p>{{ $productInventory->line }}</p>
</div>

