@extends('web.layouts.layout')

@section('content')
    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                @foreach($banners as $banner)
                    <div class="item-slick1"
                         style="background-image: url({{ route('file.show', ['file_id' => $banner -> file_id]) }});">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="fadeInDown"
                                     data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Women Collection 2018
								</span>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="fadeInUp"
                                     data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        {{$banner -> title}}
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                    <a href="#"
                                       class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Category -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{ route('file.show', ['file_id' => $category -> file_id]) }}"
                                 alt="{{$category->name}}">

                            <a href=""
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{$category->name}}
								</span>

                                    <span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10 categories">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="0">
                        All Products
                    </button>

                    @foreach($categoriesHome as $category)
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="{{$category->id}}">
                            {{$category->name}}
                        </button>
                    @endforeach

                </div>
            </div>

            <div class="row" id="product-list">

            </div>

            <!-- Load more -->
            {{--<div class="flex-c-m flex-w w-full p-t-45">--}}
            {{--<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">--}}
            {{--Load More--}}
            {{--</a>--}}
            {{--</div>--}}
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            var page = 0;

            var category_id = 0;
            var position = 0;
            $(window).scroll(function () {
                if ($(this).scrollTop() + $(this).height() > position + $(this).height() - 20) {
                    position = $(this).scrollTop() + $(this).height()-20;
                    page++;
                    console.log(page);
                    let url = window.location.origin + "/home/ajax/products?page=" + page + "&categoryId=" + category_id;

                    infinteLoadMore(page, url);
                }
            });

            $('.categories button').on('click', function () {
                page = 0;
                position= 0;
                category_id = $(this).attr('data-filter');
                $('#product-list').empty();
            })
        });

        function infinteLoadMore(page, url) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: url,
                type: "GET",
                async: false,
                data: {},
                success: function (result) {
                    console.log(result);
                    let products = result.message.products.data;

                    console.log(products);
                    let html = "";
                    $.each(products, function (key, value) {
                        let urlProductDetail = "{{route('detail.show', ['id' => 'productId'])}}";
                        let urlImage = "{{route('file.show', ['file_id' => 'file_id'])}}";
                        urlImage = urlImage.replace('file_id', value.file_id);
                        //console.log(urlImage);
                        urlProductDetail = urlProductDetail.replace('productId', value.productId);
                        //console.log(urlProductDetail);
                        html += `<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ${value.categorySlug}">`;
                        html += `<div class="block2">`;
                        html += `<div class="block2-pic hov-img0">`;
                        html += `<img src="${urlImage}" alt="IMG-PRODUCT">`;
                        html += `<a href="${urlProductDetail}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"> Quick View </a>`;
                        html += `</div>`;
                        html += `<div class="block2-txt flex-w flex-t p-t-14">`;
                        html += `<div class="block2-txt-child1 flex-col-l ">`;
                        html += `<a href="${urlProductDetail}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">`
                        html += `${value.productName}`;
                        html += `</a>`;
                        html += `<span class="stext-105 cl3">`;
                        html += `${value.price_v_3.toLocaleString('vi-VN', {style: 'decimal'})}đ`;
                        html += `</span>`;
                        html += `</div>`;
                        html += `<div class="block2-txt-child2 flex-r p-t-3">`;
                        html += `<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">`;
                        html += `<img class="icon-heart1 dis-block trans-04"`;
                        html += `src="{{ asset('web/images/icons/icon-heart-01.png') }}" alt="ICON">`;
                        html += ` <img class="icon-heart2 dis-block trans-04 ab-t-l"`;
                        html += `src="{{ asset('web/images/icons/icon-heart-02.png') }}" alt="ICON">`;
                        html += `</a>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        html += `</div>`;
                        // html += `<span class="price"></span>`;
                    });
                    $('#product-list').append(html);
                }
            })
        }
    </script>
@endpush
