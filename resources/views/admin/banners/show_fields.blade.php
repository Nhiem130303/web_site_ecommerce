<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $banner->title }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $banner->slug }}</p>
</div>

<!-- Position Field -->
<div class="col-sm-12">
    {!! Form::label('position', 'Position:') !!}
    <p>{{ $banner->position }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $banner->status }}</p>
</div>

<!-- File Id Field -->
<div class="col-sm-12">
    {!! Form::label('file_id', 'File Id:') !!}
    <p>{{ $banner->file_id }}</p>
</div>

