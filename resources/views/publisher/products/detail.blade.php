@extends('publisher.layout.layout')

@push('css')
    <link rel="stylesheet" href="{{asset('publisher/css/photoswipe.css')}}">
    <link rel="stylesheet" href="{{asset('publisher/css/default-skin.css')}}">
    <style>
        #gallery figure img {
            border-radius: 0.75rem;
            width: 75% !important;
            box-shadow: 0 .3125rem .625rem 0 rgba(0, 0, 0, .12) !important;
        }
    </style>
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4">Product Details</h5>
                <div class="row">
                    <div class="col-xl-5 col-lg-6 text-center">
                        <img class="w-100 border-radius-lg shadow-lg mx-auto"
                             src="{{route('file.show', ['file_id' => $product->images->first()->file_id ?? 10000])}}"
                             alt="chair">
                        <!-- Galley wrapper that contains all items -->
                        <div id="gallery" class="gallery d-flex mt-4 pt-2">
                            @foreach($product->images as $value)
                                <figure>
                                    <a href="{{route('file.show', ['file_id' => $value->file_id ?? 10000])}}"
                                       data-caption="Sunset in the wheat field<br><em class='text-muted'>© Jordan McQueen</em>"
                                       data-width="1200" data-height="900" itemprop="contentUrl">
                                        <img src="{{route('file.show', ['file_id' => $value->file_id ?? 100000])}}"
                                             itemprop="thumbnail"
                                             alt="Image description">
                                    </a>
                                </figure>
                            @endforeach
                        </div>

                        <!-- Some spacing 😉 -->
                        <div class="spacer"></div>


                        <!-- Root element of PhotoSwipe. Must have class pswp. -->
                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                            <!-- Background of PhotoSwipe.
                                 It's a separate element as animating opacity is faster than rgba(). -->
                            <div class="pswp__bg"></div>
                            <!-- Slides wrapper with overflow:hidden. -->
                            <div class="pswp__scroll-wrap">
                                <!-- Container that holds slides.
                                    PhotoSwipe keeps only 3 of them in the DOM to save memory.
                                    Don't modify these 3 pswp__item elements, data is added later on. -->
                                <div class="pswp__container">
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                </div>
                                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                <div class="pswp__ui pswp__ui--hidden">
                                    <div class="pswp__top-bar">
                                        <!--  Controls are self-explanatory. Order can be changed. -->
                                        <div class="pswp__counter"></div>
                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                        <button class="pswp__button pswp__button--share" title="Share"></button>
                                        <button class="pswp__button pswp__button--fs"
                                                title="Toggle fullscreen"></button>
                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                                        <!-- element will get class pswp__preloader--active when preloader is running -->
                                        <div class="pswp__preloader">
                                            <div class="pswp__preloader__icn">
                                                <div class="pswp__preloader__cut">
                                                    <div class="pswp__preloader__donut"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                        <div class="pswp__share-tooltip"></div>
                                    </div>
                                    <button class="pswp__button pswp__button--arrow--left"
                                            title="Previous (arrow left)">
                                    </button>
                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                                    </button>
                                    <div class="pswp__caption">
                                        <div class="pswp__caption__center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mx-auto">
                        <h3 class="mt-lg-0 mt-4">{{$product->name}}</h3>
                        <div class="rating">
                            <i class="fas fa-star" aria-hidden="true"></i>
                            <i class="fas fa-star" aria-hidden="true"></i>
                            <i class="fas fa-star" aria-hidden="true"></i>
                            <i class="fas fa-star" aria-hidden="true"></i>
                            <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                        </div>
                        <br>
                        <h6 class="mb-0 mt-3">Price</h6>
                        <h5>{{ numberFormat($product->plv1) }} - {{ numberFormat($product->plv3)}}đ</h5>
                        <span class="badge badge-success">In Stock</span>
                        <style>
                            .variant_items {
                                margin-bottom: 15px;
                            }

                            .variant_items .title-variant {
                                color: #20315c;
                                padding-bottom: 5px;
                                font-size: 15px;
                                position: relative;
                                margin-bottom: 5px;
                            }

                            .product_wapper_variant ul {
                                flex-wrap: wrap;
                                padding-left: 0;
                                display: flex;
                                margin: 0 -5px;
                            }

                            .product_wapper_variant ul li {
                                -webkit-box-flex: 0;
                                -ms-flex: 0 0 25%;
                                flex: 0 0 25%;
                                max-width: 25%;
                                position: relative;
                                list-style: none;
                                padding: 0 5px 10px;
                            }

                            .attribute_group_name label, .product_variant_option label {
                                width: 100%;
                                height: 100%;
                                margin-bottom: 0px;
                                border-radius: 4px;
                                color: #20315C;
                                font-size: 16px;
                                border: 1px solid #CFCFCF;
                                float: left;
                                cursor: pointer;
                                list-style: none;
                                background-color: #ffffff;
                                padding: 8px;
                                text-align: center;
                            }

                            .product_wapper_variant li.active label, .product_wapper_variant ul li.active label {
                                color: #292BB7;
                                border-color: #292BB7;
                                background: #E9E9FF;
                                font-weight: 600;
                            }

                            .product_variant_option li {
                                display: none;
                            }
                        </style>
                        <div class="product_attribute">
                            <div class="product_wapper">
                                <div class="product_wapper_variant">
                                    <div class="variant_items">

                                        <?php
                                        $aryHidden = [];

                                        $i = 0;
                                        ?>

                                        @foreach($productVariants as $key => $variant)
                                            <?php
                                            ksort($variant);

                                            $attrValue = current($variant)['attr_value'];

                                            $attrName = current($variant)['attr_name'];
                                            ?>

                                            @if(!in_array($attrName, $aryHidden))
                                                <div class="title-variant">{{$attrName}}:</div>
                                            @endif

                                            @if($i == 0)
                                                <ul class="attribute_group_name {{\Illuminate\Support\Str::slug($attrName)}}">
                                                    @endif

                                                    @if (!in_array($attrValue, $aryHidden))
                                                        <li id="{{\Illuminate\Support\Str::slug($attrValue)}}">
                                                            <label for="">{{$attrValue}}</label>
                                                        </li>
                                                    @endif

                                                    @if($i == count($productVariants))
                                                </ul>
                                            @endif

                                            <?php
                                            $aryHidden[] = $attrValue;

                                            $aryHidden[] = $attrName;

                                            $i++;
                                            ?>
                                        @endforeach
                                    </div>
                                    <div class="variant_items">

                                        @php
                                            $i = 0;
                                        @endphp

                                        @foreach($productVariants as $key => $variant)
                                            <?php
                                            ksort($variant);

                                            $attrName = last($variant)['attr_name'];

                                            $attrValue = last($variant)['attr_value'];
                                            ?>

                                            @if(!in_array($attrName, $aryHidden))
                                                <div class="title-variant">{{$attrName}}:</div>
                                            @endif

                                                @if($i == 0)
                                                    <ul class="product_variant_option {{\Illuminate\Support\Str::slug($attrName)}}">
                                                        @endif

                                                        <li id="{{\Illuminate\Support\Str::slug(current($variant)['attr_value'])}}-{{\Illuminate\Support\Str::slug($attrValue)}}"
                                                            data-name="{{\Illuminate\Support\Str::slug(current($variant)['attr_value'])}}"
                                                            data-product-variant-id="{{$key}}">
                                                            <label for="">{{$attrValue}}</label>
                                                            <input type="hidden" name="product_variant" value="{{$key}}">
                                                        </li>

                                                        @if($i == count($productVariants))
                                                    </ul>
                                                @endif
                                            <?php
                                            $aryHidden[] = $attrName;

                                            $i++;
                                            ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>
                        <label class="">Description</label>
                        <ul>
                            <li>The most beautiful curves of this swivel stool adds an elegant touch to any
                                environment
                            </li>
                            <li>Memory swivel seat returns to original seat position</li>
                            <li>Comfortable integrated layered chair seat cushion design</li>
                            <li>Fully assembled! No assembly required</li>
                        </ul>
                        <div class="row mt-4">
                            <div class="col-lg-5">
                                <button class="btn bg-gradient-primary mb-0 mt-lg-auto w-100" type="button"
                                        name="button">Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('publisher/js/plugins/photoswipe.min.js')}}"></script>
    <script src="{{asset('publisher/js/plugins/photoswipe-ui-default.min.js')}}"></script>
    <script>
        'use strict';

        (function ($) {

            // Init empty gallery array
            var container = [];

            // Loop over gallery items and push it to the array
            $('#gallery').find('figure').each(function () {
                var $link = $(this).find('a'),
                    item = {
                        src: $link.attr('href'),
                        w: $link.data('width'),
                        h: $link.data('height'),
                        title: $link.data('caption')
                    };
                container.push(item);
            });

            // Define click event on gallery item
            $('#gallery figure a').click(function (event) {

                // Prevent location change
                event.preventDefault();

                // Define object and gallery options
                var $pswp = $('.pswp')[0],
                    options = {
                        index: $(this).parent('figure').index(),
                        bgOpacity: 0.85,
                        showHideOpacity: true
                    };

                // Initialize PhotoSwipe
                var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, container, options);
                gallery.init();
            });

        }(jQuery));
    </script>
    <script>
        $(document).ready(function () {
            $(".attribute_group_name li").first().addClass('active');

            if ($(".attribute_group_name li").hasClass('active')) {
                let id = $(".attribute_group_name li").attr('id');

                $(`.product_variant_option li[data-name="${id}"]`).show();

                $(`.product_variant_option li[data-name="${id}"]`).first().addClass('active');
            }

            $(".product_variant_option li").click(function () {
                $(".product_variant_option li").removeClass("active");

                $(this).addClass("active");
            });

            $(".attribute_group_name li").click(function () {
                $(".attribute_group_name li").removeClass("active");

                $(".product_variant_option li").removeClass("active");

                $(".product_variant_option li").hide();

                $(this).addClass("active");

                let productVariant = $(this).attr("id");

                $(`.product_variant_option li[data-name="${productVariant}"]`).show();

                $(`.product_variant_option li[data-name="${productVariant}"]`).first().addClass('active');
            });
        });
    </script>
@endpush