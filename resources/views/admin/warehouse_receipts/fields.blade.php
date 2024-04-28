<div class="form-group col-sm-6">
    {!! Form::label('product_variant_id', 'Product variant ID:') !!}
    {!! Form::number('product_variant_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Location:') !!}
    <select class="form-control" name="location_id">
        @foreach($locations as $location)
            <option value="{{$location->id}}">{{$location->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', 1, ['class' => 'form-control', 'required']) !!}
</div>