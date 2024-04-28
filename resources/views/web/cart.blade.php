@extends('web.layouts.layout')

@section('content')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-10 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Shopping Cart
            </span>
        </div>
    </div>

    <!-- Shoping Cart -->
    @if ($items->isEmpty())
        <div class="text-center" style="height: 50vh">
            <p class="mt-5 h6">Your cart is currently empty.</p>
            <a href="{{ route('home.show') }}" class="btn btn-info btn-lg mt-5 h4">
                <span>Return to shop</span>
            </a>
        </div>
    @else
        <form class="bg0 p-t-25 p-b-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Price</th>
                                        <th class="column-4">Quantity</th>
                                        <th class="column-5">Total</th>
                                    </tr>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($items as $item)
                                        <tr class="table_row cart_item" data-id="{{ $item->id }}">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="{{ route('file.show', $item->attributes->image) }}"
                                                        alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">{{ $item->name }}</td>
                                            <td class="column-3">{{ numberFormat($item->price) }}</td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                        name="num-product1" value="{{ $item->quantity }}">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">{{ numberFormat($item->price * $item->quantity) }}</td>
                                        </tr>
                                        @php
                                            $total += $item->price * $item->quantity;
                                        @endphp
                                    @endforeach
                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                        name="coupon" placeholder="Coupon Code">

                                    <div
                                        class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Apply coupon
                                    </div>
                                </div>

                                <button id="update-cart" type="button" name="update_cart"
                                    class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Update Cart
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Cart Totals
                            </h4>

                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Subtotal:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        {{ numberFormat($total) }} đ
                                    </span>
                                </div>
                            </div>

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        Shipping:
                                    </span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <div>
                                        @php
                                            $hasAddress = false;
                                            if (isset($address['address']->attributes['street'])) {
                                                $addressCart = $address['address']->attributes;
                                                $hasAddress = true;
                                            }
                                        @endphp
                                        @if ($hasAddress)
                                            <p class="stext-111 cl6 p-t-2">
                                                Shopping to
                                                <strong
                                                    class="address-detail">{{ $addressCart['street'] . ', ' . $addressCart['ward'] . ', ' . $addressCart['district'] . ', ' . $addressCart['city'] }}</strong>
                                            </p>
                                        @else
                                            <p class="stext-111 cl6 p-t-2 address-content" hidden>
                                                Shopping to
                                                <strong class="address-detail"></strong>
                                            </p>
                                        @endif
                                        <div class="p-t-15">
                                            <span class="stext-112 cl8">
                                                New Address
                                            </span>
                                            <div class="form-group city p-t-10">
                                                <select name="cart_city" id="select-city" class="form-control select-city"
                                                    data-placeholder="Select a city">
                                                    <option>Select a city</option>
                                                </select>
                                            </div>

                                            <div class="form-group district">
                                                <select name="cart_district" id="select-district"
                                                    class="form-control select-district"
                                                    data-placeholder="Select a district">
                                                    <option>Select a district</option>
                                                </select>
                                            </div>

                                            <div class="form-group ward">
                                                <select name="cart_ward" id="select-ward" class="form-control select-ward"
                                                    data-placeholder="Select a ward">
                                                    <option>Select a ward</option>
                                                </select>
                                            </div>

                                            <div class="bg0 m-b-22">
                                                <input class="select form-control" name="cart_street" id="cart_street"
                                                    placeholder="Street address" value="" />
                                            </div>

                                            <div class="flex-w">
                                                <div id="update-address"
                                                    class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                                    Update Address
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Total:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        {{ numberFormat($total) }} đ
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.show') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection

@push('scripts')
    <script>
        async function loadCity() {
            const response = await fetch('{{ asset('locations/index.json') }}');
            const cities = await response.json();

            let string = ``;
            $.each(cities, function(index, each) {
                string += `<option data-path="${each.file_path}">${index}</option>`;
            });
            $('#select-city').append(string);
        }

        async function loadDistrict() {
            $("#select-district").empty();
            $("#select-ward").empty();

            const path = $("#select-city option:selected").data('path');

            if (!path) {
                return;
            }

            const response = await fetch('{{ asset('locations/') }}' + path);
            const districts = await response.json();

            // let string = '';
            let string = `<option value="">Select a district</option>`;

            $.each(districts.district, function(index, each) {
                string += `<option data-path="${each.name}">${each.pre} ${each.name}</option>`;
            });

            $('#select-district').append(string);
        }

        async function loadWard() {
            $("#select-ward").empty();

            const pathCity = $(".select-city option:selected").data('path');
            const pathDistrict = $(".select-district option:selected").data('path');

            if (!pathCity || !pathDistrict) {
                return;
            }

            const responseCity = await fetch('{{ asset('locations/') }}' + pathCity);
            const responseDistrict = await responseCity.json();

            var district = responseDistrict.district.find(function(district) {
                return district.name === pathDistrict;
            });

            let string = `<option value="">Select a ward</option>`;

            $.each(district.ward, function(index, each) {
                string += `<option>${each.pre} ${each.name}</option>`;
            });

            $("#select-ward").append(string);
        }

        $(document).ready(function() {
            // select 2
            $('#select-city').select2({
                tags: true
            });

            $('#select-district').select2({
                tags: true
            });

            $('#select-ward').select2({
                tags: true
            });

            // Load city
            loadCity();

            // Load district after change city
            $("#select-city").change(function() {
                loadDistrict();
            });

            $("#select-district").change(function() {
                loadWard();
            });

            // update cart
            $(document).on('click', '#update-cart', function() {
                arr = {};

                $('.cart_item').each(function() {
                    var dataId = $(this).data('id');
                    var quantity = $(this).find('input[type="number"]').val();

                    if (dataId !== undefined && quantity !== undefined) {
                        arr[dataId] = quantity;
                    }
                });

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: '/cart/update',
                    data: {
                        arr: arr
                    },
                    success: function(resp) {
                        $.toast({
                            heading: 'Success',
                            text: resp['message'],
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'success'
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function() {
                        $.toast({
                            heading: 'Error',
                            text: 'Item added failed',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'error'
                        })
                    }
                });
            });

            // update address
            $(document).on('click', '#update-address', function() {
                let city = $("#select-city option:selected").val();
                let district = $("#select-district option:selected").val();
                let ward = $("#select-ward option:selected").val();
                let street = $("#cart_street").val().replace(/  +/g, ' ').trim();

                arr = {};

                arr['city'] = city;
                arr['district'] = district;
                arr['ward'] = ward;
                arr['street'] = street;

                if (city === '' || district === '' || ward === '' || street === '') {
                    $.toast({
                        heading: 'Address entry failed',
                        text: 'Please enter all fields',
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'warning'
                    });
                    return;
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: '/cart/update-address',
                    data: {
                        arr: arr
                    },
                    success: function(resp) {
                        $.toast({
                            heading: 'Success',
                            text: resp['message'],
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'success'
                        });
                        $('.address-detail').text(street + ', ' + ward + ', ' + district +
                            ', ' + city);
                        $('.address-content').removeAttr('hidden');
                    },
                    error: function() {
                        $.toast({
                            heading: 'Error',
                            text: 'Address updated failed',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'error'
                        })
                    }
                });
            });

            // Remove item
            // $(document).on('click', '.cart-remove', function() {
            //     // Confirm the deletion using SweetAlert2
            //     Swal.fire({
            //         title: 'Are you sure?',
            //         text: "You won't be able to revert this!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Yes, delete it!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             var product_variant_id = $(this).attr('data-product_id');
            //             $(this).parents().eq(1).remove();
            //
            //             var total = getTotalMoney();
            //
            //             $('.total-money').text(total.toLocaleString());
            //
            //             $.ajax({
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
            //                         .attr('content')
            //                 },
            //                 type: 'post',
            //                 url: '/cart/remove',
            //                 data: {
            //                     id: product_variant_id
            //                 },
            //                 success: function(resp) {
            //                     $.toast({
            //                         heading: 'Success',
            //                         text: resp['message'],
            //                         showHideTransition: 'slide',
            //                         position: 'bottom-right',
            //                         icon: 'success'
            //                     });
            //                 },
            //                 error: function() {
            //                     $.toast({
            //                         heading: 'Error',
            //                         text: 'Item added failed',
            //                         showHideTransition: 'slide',
            //                         position: 'bottom-right',
            //                         icon: 'error'
            //                     })
            //                 }
            //             })
            //         }
            //     })
            // });
            // Quantity button
            // $(".minus").click(function() {
            //     $("#update-cart").css('opacity', '1').removeAttr('disabled');
            //     var $input = $(this).parent().find("input");
            //     var count = parseInt($input.val()) - 1;
            //     count = count < 1 ? 1 : count;
            //     $input.val(count);
            //     $input.change();
            //     return false;
            // });
            // $(".plus").click(function() {
            //     $("#update-cart").css('opacity', '1').removeAttr('disabled');
            //     var $input = $(this).parent().find("input");
            //     $input.val(parseInt($input.val()) + 1);
            //     $input.change();
            //     return false;
            // });
            // function getTotalMoney() {
            //     var total = 0;
            //
            //     $('.total-item-money').each(function () {
            //         var value = parseInt($(this).text().replace(/\D/g, ''));
            //
            //         if (!isNaN(value)) {
            //             total += value;
            //         }
            //     });
            //
            //     return total;
            // }});
        });
    </script>
@endpush
