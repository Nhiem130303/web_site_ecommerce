<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $category->name }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $category->slug }}</p>
</div>

<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{{ $category->parent_id }}</p>
</div>

<!-- File Id Field -->
<div class="col-sm-12">
    {!! Form::label('file_id', 'File Id:') !!}
    <p>{{ $category->file_id }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $category->status }}</p>
</div>

