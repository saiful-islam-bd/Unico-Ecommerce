@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Vendor Details Page
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Vendor Details Page
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="archive-header-2 text-center pt-80 pb-50">
        <h1 class="display-2 mb-50"> {{ $vendor->name }} </h1>

    </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($vproduct) }}</strong> items for you!</p>
                </div>
            </div>
            <div class="row product-grid">



                @foreach ($vproduct as $product)
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                        <img class="default-img" src="{{ asset($product->product_thambnail) }}"
                                            alt="" />

                                    </a>
                                </div>
                                <div class="product-action-1">

                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                        onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                        onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                        onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>

                                </div>

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($amount / $product->selling_price) * 100;

                                @endphp


                                <div class="product-badges product-badges-position product-badges-mrg">

                                    @if ($product->discount_price == null)
                                        <span class="new">New</span>
                                    @else
                                        <span class="hot"> {{ round($discount) }} %</span>
                                    @endif


                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                </div>
                                <h2><a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                        {{ $product->product_name }} </a></h2>
                                @php

                                    $reviewcount = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();

                                    $avarage = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                @endphp

                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">

                                        @if ($avarage == 0)
                                        @elseif($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                    <span class="font-small ml-5 text-muted"> ({{ count($reviewcount) }})</span>
                                </div>



                                <div>
                                    @if ($product->vendor_id == null)
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">Owner</a></span>
                                    @else
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>
                                    @endif



                                </div>
                                <div class="product-card-bottom">

                                    @if ($product->discount_price == null)
                                        <div class="product-price">
                                            <span>${{ $product->selling_price }}</span>

                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $product->discount_price }}</span>
                                            <span class="old-price">${{ $product->selling_price }}</span>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach






            </div>

        </div>

        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img src="{{ !empty($vendor->photo) ? url('upload/vendor_images/' . $vendor->photo) : url('upload/no_image.jpg') }}"
                        alt="" />
                </div>
                <div class="vendor-info">
                    <div class="product-category">
                        <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                    </div>
                    <h4 class="mb-5">
                        <a href="#!" class="text-heading">
                            {{ $vendor->name }}
                        </a>
                        <span>({{ $vendor->vendor_rating }})</span>
                    </h4>

                    {{-- <div class="product-rate-cover mb-15">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: 90%"></div>
                        </div>
                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                    </div> --}}

                    <style>
                        .rate {
                            float: left;
                            height: 46px;
                            padding: 0 10px;
                        }

                        .rate:not(:checked)>input {
                            position: absolute;
                            top: -9999px;
                        }

                        .rate:not(:checked)>label {
                            float: right;
                            width: 1em;
                            overflow: hidden;
                            white-space: nowrap;
                            cursor: pointer;
                            font-size: 30px;
                            color: #ccc;
                        }

                        .rate:not(:checked)>label:before {
                            content: '★ ';
                        }

                        .rate>input:checked~label {
                            color: #ffc700;
                        }

                        .rate:not(:checked)>label:hover,
                        .rate:not(:checked)>label:hover~label {
                            color: #deb217;
                        }

                        .rate>input:checked+label:hover,
                        .rate>input:checked+label:hover~label,
                        .rate>input:checked~label:hover,
                        .rate>input:checked~label:hover~label,
                        .rate>label:hover~input:checked~label {
                            color: #c59b08;
                        }
                    </style>
                    <div class="product-rate-cover mb-15">
                        <form action="{{ route('vendor_rating', $vendor->id) }}">
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                            <input type="submit" class="btn" value="Submit" style="height: 3rem;">
                        </form>
                    </div>


                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                    </div>
                    <div class="follow-social mb-20">
                        <h6 class="mb-15">Follow Us</h6>
                        <ul class="social-network">
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg"
                                    alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span>
                            </li>
                            <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg"
                                    alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                        </ul>
                        <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>


            <!-- Fillter By Price -->


        </div>
    </div>
</div>



@endsection
