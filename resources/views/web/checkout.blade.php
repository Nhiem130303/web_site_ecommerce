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
                Check out
            </span>
        </div>
    </div>
    @if ($data->isEmpty())
        <div class="text-center" style="height: 50vh">
            <p class="mt-5 h6">Checkout is not available whilst your cart is currently empty.</p>
            <a href="{{ route('home.show') }}" class="btn btn-info btn-lg mt-5 h4">
                <span>Return to shop</span>
            </a>
        </div>
    @elseif($address->isEmpty())
        <div class="text-center" style="height: 50vh">
            <p class="mt-5 h6">Checkout is not available whilst your address is currently empty</p>
            <a href="{{ route('cart.show') }}" class="btn btn-info btn-lg mt-5 h4">
                <span>Return to cart</span>
            </a>
        </div>
    @else
        <form method="POST" action="{{ route('order.store') }}" name="billing" class="billing bg0 p-t-25 p-b-85" id="billing">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-lg-8 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 p-lr-40 m-r-25 m-lr-0-xl p-t-30 p-b-40 bor10 p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Billing Details
                            </h4>
                            @php
                                if (isset($address['address']->attributes['street'])) {
                                        $address = $address['address']->attributes;
                                    }
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <input disabled name="billing_city" id="billing_city"
                                           class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3"
                                           value="{{ $address['city'] ?? '' }}">
                                    <input hidden name="city_id" value="1">
                                </div>

                                <div class="col-md-6">
                                    <input disabled name="billing_district" id="billing_district"
                                           class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3"
                                           value="{{ $address['district'] ?? '' }}">
                                    <input hidden name="district_id" value="1">
                                </div>

                                <div class="col-md-6">
                                    <input disabled name="billing_ward" id="billing_ward"
                                           class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3"
                                           value="{{ $address['ward'] ?? '' }}">
                                    <input hidden name="ward_id" value="1">
                                </div>
                                <div class="col-md-6">
                                    <input disabled name="billing_street" id="billing_street"
                                           class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3"
                                           value="{{ $address['street'] ?? '' }}">
                                    <input hidden name="address" value="demo_address">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3" id="billing_email"
                                           name="email" placeholder="Email address"/>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3"
                                           name="user_first_name" placeholder="First name" id="billing_first_name"/>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3"
                                           id="billing_last_name" name="user_last_name" placeholder="Last name"/>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="size-107 bor8 m-b-22 stext-116 cl8 plh3 w-100 p-3" id="billing_phone"
                                           name="phone_number" placeholder="Phone number"/>
                                </div>
                                <div class="col-12 form-group">
                                     <textarea placeholder="Notes about your order, e.g. special notes for delivery."
                                               name="note" id="billing_note" class="size-107 bor8 stext-116 cl8 plh3 p-3 form-control h-100"
                                               rows="5"
                                     ></textarea>
                                </div>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('cart.show') }}" name="update_cart" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Return Cart
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-8 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                YOUR ORDER
                            </h4>

                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                        <span class="stext-110 cl2">
                                            Product
                                        </span>
                                </div>

                                <div class="size-209">
                                        <span class="stext-110 cl2 float-right">
                                            SubTotal
                                        </span>
                                </div>
                            </div>
                            @php
                                $total = 0;
                            @endphp
                            @foreach($data as $item)
                                <div class="flex-w flex-t bor12 p-t-10 p-b-13">
                                    <div class="size-208">
                                            <span class="stext-111 cl6">
                                                {{ $item->name }}  <strong
                                                        class="">&nbsp;&nbsp;&nbsp;x {{ $item->quantity }}</strong>
                                            </span>
                                    </div>

                                    <div class="size-209">
                                            <span class="stext-110 cl2 float-right">
                                                {{ numberFormat($item->quantity * $item->price) }}
                                            </span>
                                    </div>
                                </div>
                                @php
                                    $total += $item->quantity * $item->price;
                                @endphp
                                <input name="order_items[{{ $item->id }}][product_id]" hidden
                                       value="{{ $item->attributes->product_id }}">
                                <input name="order_items[{{ $item->id }}][product_variant_id]"
                                       hidden value="{{ $item->id }}">
                                <input name="order_items[{{ $item->id }}][quantity]" hidden
                                       value="{{ $item->quantity }}">
                                <input name="order_items[{{ $item->id }}][price]" hidden
                                       value="{{ $item->price }}">
                            @endforeach

                            <div class="flex-w flex-t p-t-15 p-b-10">
                                <div class="size-208 w-full-ssm">
                                        <span class="stext-110 cl2">
                                            Shipping:
                                        </span>
                                </div>

                                <div class="size-209 p-r-0-sm w-full-ssm">
                                    <span class="stext-110 cl2 float-right">...</span>
                                </div>
                            </div>
                            <hr>
                            <div class="flex-w flex-t p-t-10 p-b-33">
                                <div class="size-208">
                                        <span class="mtext-101 cl2">
                                            Total:
                                        </span>
                                </div>
                                <div class="size-209 p-t-1">
                                        <span class="mtext-110 cl2 float-right">
                                            {{ numberFormat($total) }} đ
                                        </span>
                                </div>
                            </div>

                            <input name="amount" value="{{ $total }}" hidden>

                            <a id="order"
                               href="javascript:void(0)"
                               class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Complete checkout
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
        $(document).ready(function () {
            $(document).on('click', '#order', function () {
                // Confirm the deletion using SweetAlert2
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, order it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var email = $("#billing_email").val().replace(/  +/g, ' ').trim();
                        var firstName = $("#billing_first_name").val().replace(/  +/g, ' ')
                            .trim();
                        var lastName = $("#billing_last_name").val().replace(/  +/g, ' ')
                            .trim();
                        var phone = $("#billing_phone").val().replace(/  +/g, ' ').trim();

                        if (email === '' || firstName === '' || lastName === '' || phone === '') {
                            $.toast({
                                heading: 'Order failed',
                                text: 'Please enter all fields',
                                showHideTransition: 'slide',
                                position: 'bottom-right',
                                icon: 'warning'
                            });
                            return;
                        }

                        $('#billing').submit();
                    }
                })
            });
        });
    </script>
@endpush
