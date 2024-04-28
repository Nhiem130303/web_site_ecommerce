<!-- Product Id Field -->
<div class="col-sm-12">
    {!! Form::label('product_id', 'Product Id:') !!}
    <p>{{ $productVariant->product_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $productVariant->name }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $productVariant->slug }}</p>
</div>

<!-- Plv 1 Field -->
<div class="col-sm-12">
    {!! Form::label('plv_1', 'Plv 1:') !!}
    <p>{{ $productVariant->plv_1 }}</p>
</div>

<!-- Plv 2 Field -->
<div class="col-sm-12">
    {!! Form::label('plv_2', 'Plv 2:') !!}
    <p>{{ $productVariant->plv_2 }}</p>
</div>

<!-- Plv 3 Field -->
<div class="col-sm-12">
    {!! Form::label('plv_3', 'Plv 3:') !!}
    <p>{{ $productVariant->plv_3 }}</p>
</div>

