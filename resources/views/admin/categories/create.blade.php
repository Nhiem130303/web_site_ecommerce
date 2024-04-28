@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Categories
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'admin.categories.store', 'enctype' => "multipart/form-data"]) !!}

            <div class="card-body">

                <div class="row">
                    @include('admin.categories.fields')
                    <!-- Parent Id Field -->
                        <div class="form-group col-sm-12">
                            <select name="parent_id" class="w-100 form-control">
                                <option value="0">Category Parent</option>
                                @foreach($categories as $categoryParent)
                                    <option value="{{$categoryParent->id}}">{{$categoryParent->name}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
