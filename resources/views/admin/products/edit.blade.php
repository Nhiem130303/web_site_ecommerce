@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Product
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'patch', 'enctype' => "multipart/form-data"]) !!}

            <div class="card-body">
                <div class="row">
                    @include('admin.products.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.products.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <section class="content-header">
        <div class="row">
            <div class="col-12">
                <h1 class="float-left">Product Images</h1>
            </div>
            <div class="col-12 mt-3">
                <div class="card card-primary">
                    <div class="card-body">
                        @include('publisher.layout.alert')
                        {!! Form::open(['route' => ['admin.products.set_default', $product->id], 'method' => 'post']) !!}
                        <div class="row">
                            @foreach($product->images as $value)
                                <div class="col-sm-2 position-relative product_img">
                                    <label for="{{$value->id}}" class="d-block position-absolute"
                                           style="top: 0; left: 0; right: 0; bottom: 0;"
                                    >
                                        <input type="radio" id="{{$value->id}}" class="d-none img_default" name="img_default"
                                               value="{{$value->id}}">
                                    </label>
                                    <a href="{{route('file.delete', ['file_id' => $value->file_id])}}"
                                       class="btn btn-danger btn-xs float-right"
                                       onclick="return confirm('Are you sure?')">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <img src="{{route('file.show', ['file_id' => $value->file_id])}}"
                                         class="img-fluid mb-2">
                                </div>
                            @endforeach
                            <div class="col-12">
                                <button class="btn btn-primary btn-lg">Save</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-header">
        <h1 class="float-left">Product Variant</h1>
        <h1 class="float-right">
            <a class="btn btn-sm btn-primary pull-right" style="margin-bottom: 5px"
               href="{{ route('admin.productVariants.create', ["product_id" => $product->id]) }}">Add New</a>
        </h1>
        <div class="clearfix"></div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                @include('admin.product_variants.table')
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function () {
            $(".img_default").on('click', function () {
                $(".img-fluid").css('transform', '');
                $(this).parents('.product_img').find('.img-fluid').css('transform', 'scale(0.9)');
            })
        })
    </script>
@endpush
