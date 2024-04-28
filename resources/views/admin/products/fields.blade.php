<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('plv1', 'Plv1:') !!}
    {!! Form::number('plv1', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('plv2', 'Plv2:') !!}
    {!! Form::number('plv2', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('plv3', 'Plv3:') !!}
    {!! Form::number('plv3', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('category_id', 'Danh mục:') !!}
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Trạng thái:') !!}
    <select name="status" class="form-control">
        <option value="1">Hoạt động</option>
        <option value="0">Không hoạt động</option>
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('upload', 'Upload File:') !!}
    {!! Form::file('file[]', ['class' => 'form-control border-0', 'multiple' => true]) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('short_desc', 'Description:') !!}
    {!! Form::textarea('short_desc', null, ['class' => 'form-control', 'rows' => '4']) !!}
</div>