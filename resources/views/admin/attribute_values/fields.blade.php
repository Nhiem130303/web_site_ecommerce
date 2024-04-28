<div class="form-group col-sm-6">
    {!! Form::label('attribute_id', 'Thuộc tính:') !!}
    <select name="attribute_id" class="form-control">
        @foreach($attributes as $value)
            <option @if(isset($attributeValue) && $attributeValue->attribute_id == $value->id) selected
                    @endif value="{{$value->id}}">{{$value->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::text('value', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>