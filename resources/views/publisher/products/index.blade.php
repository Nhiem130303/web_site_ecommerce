@extends('publisher.layout.layout')

@push('css')
    <link rel="stylesheet" href="{{asset('publisher/css/products_table.css')}}">
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0 px-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Toàn bộ sản phẩm</h5>
                        <p class="text-sm mb-0 ">
                            Sử dụng bộ lọc để tìm sản phẩm nhanh hơn!
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="row">
                    <div class="col-3 mb-2">
                        <form action="{{route('products')}}" method="get">
                            <div class="input-group formSearch">
                                <style>

                                    .formSearch {
                                        position: relative;
                                    }

                                    .formSearch {
                                        border-radius: 0.5rem;
                                        overflow: hidden;
                                        border: 1px solid #d2d6da;
                                        background: white !important;
                                    }

                                    .formSearch button {
                                        position: absolute;
                                        top: 5px;
                                        z-index: 100;
                                        background: none;
                                        border: 0;
                                    }

                                    .formSearch input {
                                        border: 0;
                                        padding-left: 3.5rem;
                                    }

                                    .formSearch input:focus {
                                        box-shadow: none !important;
                                    }

                                    .formSearch input:focus {
                                        box-shadow: none !important;
                                    }
                                </style>
                                <button class="input-group-text text-body icon_search">
                                    <i class="fas fa-search"></i>
                                </button>
                                <input type="text" name="sku" class="form-control" placeholder="Mã SKU: (Ví dụ QT-1)"
                                       value="{{request('sku')}}" style="border-left: 0;">
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <a class="dataTable-container">
                                    <table class="table table-flush dataTable-table" id="products-list">
                                        <thead class="thead-light">
                                        <tr align="center">
                                            <th width="40%">
                                                <a href="#">Product</a>
                                            </th>
                                            <th width="20%">
                                                <a href="#">Price</a>
                                            </th>
                                            <th width="20%">
                                                <a href="#">Status</a>
                                            </th>
                                            <th width="20%">
                                                <a href="#">SKU</a>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr align="center">
                                                <td>
                                                    <a href="{{route('products.detail', ['id' => $product->id])}}"
                                                       class="d-flex  align-items-center">
                                                        <img class="ms-3"
                                                             width="125"
                                                             src="{{route('file.show', $product->img_is_default)}}"
                                                             alt="hoodie">
                                                        <h6 class="ms-3 my-auto">{{$product->name}}</h6>
                                                    </a>
                                                </td>
                                                <td class="text-sm">{{ numberFormat($product->plv1) }}
                                                    - {{ numberFormat($product->plv3)}}</td>
                                                <td>
                                                    @if($product->inventory_status == 0)
                                                        <span class="badge badge-warning">Out Stock</span>
                                                    @else
                                                        <span class="badge badge-success">In Stock</span>
                                                    @endif
                                                </td>
                                                <td class="text-sm">{{$product->sku}}</td>
                                            </tr>
                                        @endforeach
                                        @if($products->isEmpty() && request('sku'))
                                            <tr align="center">
                                                <td colspan="3"><h5>Không tồn tại sản phẩm</h5></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </a>
                            </div>
                            <div class="dataTable-bottom">
                                {{$products->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection