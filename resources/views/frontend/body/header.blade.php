@php
    $setting = App\Models\SiteSetting::find(1);
@endphp


<style>
    .custom_desktop_menu_none {
        display: none;
    }

    .custom_header_cart {
        padding-left: 120px;
        padding-top: 25px;
    }

    .custom_logo {
        width: 120px;
        margin-left: 15px;
    }

    @media only screen and (max-width: 600px) {
        .custom_desktop_menu_none {
            display: block;
        }

        .custom_mobile_menu_none {
            display: none;
        }

        .custom_logo_header {
            text-align: center;
        }

        .custom_header_cart {
            padding-left: 40px;
            padding-top: 20px;
        }

        .custom_logo {
            width: 120px;
            /* width: 60px; */
            margin-left: 0;
        }

    }
</style>


<!-- Header  -->
<header class="sticky-bar">

    <div class="container">

        <!-- ******************** Mobile and Desktop header ******************** -->
        <div class="row mt-2">

            <div class="col-3 col-sm-3 custom_desktop_menu_none">
                <div class="burger-icon burger-icon-white" style="margin-top: 25px;margin-left: 7px;">
                    <span class="burger-icon-top"></span>
                    <span class="burger-icon-mid"></span>
                    <span class="burger-icon-bottom"></span>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-3 col-lg-3 custom_logo_header">
                <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" class="custom_logo"
                        alt="logo" /></a>
            </div>

            <div class="col-md-6 col-lg-6 custom_mobile_menu_none">
                <div class="search-style-3" style="padding-top: 13px;">
                    <form action="{{ route('product.search') }}" method="post">
                        @csrf
                        <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                            id="search" placeholder="Search for items..." />
                        <div id="searchProducts"></div>
                    </form>
                </div>
            </div>

            <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                <div class="row">

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 custom_header_cart">
                        <div class="header-action-right" style="display: block;">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="#">
                                        <img alt=""
                                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                        <span class="pro-count blue" id="cartQty">0</span>
                                    </a>
                                    {{-- <a href="{{ route('mycart') }}"><span class="lable">Cart</span></a> --}}
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">

                                        <!--   // mini cart start with ajax -->
                                        <div id="miniCart"></div>
                                        <!--   // End mini cart start with ajax -->

                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span id="cartSubTotal"> </span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ route('mycart') }}"
                                                    style="width: 100%; text-align:center;">View
                                                    cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 custom_mobile_menu_none" style="padding-top: 20px;">
                        <div class="header-action-icon-2">
                            <a href="{{ route('login') }}">
                                <img class="svgInject" alt="Nest"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                            </a>


                            @auth
                                <a href="{{ route('dashboard') }}"><span class="lable ml-0">Account</span></a>
                                {{-- <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                    <ul>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My
                                                Account</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i
                                                    class="fi fi-rs-location-alt mr-10"></i>Order
                                                Tracking</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-label mr-10"></i>My
                                                Voucher</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-heart mr-10"></i>My
                                                Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i
                                                    class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.logout') }}"><i
                                                    class="fi fi-rs-sign-out mr-10"></i>Sign
                                                out</a>
                                        </li>
                                    </ul>
                                </div> --}}
                            @else
                                <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>

                                <span class="lable" style="margin-left: 2px; margin-right: 2px;"> | </span>


                                <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>

                            @endauth




                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- ******************** End: Mobile and Desktop header ******************** -->


        <!-- ******************** Desktop Menus ******************** -->
        @php
            $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
        @endphp
        <div class="row">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="header-nav d-none d-lg-flex justify-between">


                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active " style="  !inportent" href="#">
                                <span class="fi-rs-apps" style="color: #fff;"></span> All Categories
                                <i class="fi-rs-angle-down" style="color: #fff;"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        @foreach ($categories as $item)
                                            @if ($loop->index < 5)
                                                <li>
                                                    <a
                                                        href="{{ url('product/category/' . $item->id . '/' . $item->category_slug) }}">
                                                        <img src="{{ asset($item->category_image) }}" alt="" />
                                                        {{ $item->category_name }} </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <ul class="end">
                                        @foreach ($categories as $item)
                                            @if ($loop->index > 4)
                                                <li>
                                                    <a
                                                        href="{{ url('product/category/' . $item->id . '/' . $item->category_slug) }}">
                                                        <img src="{{ asset($item->category_image) }}" alt="" />
                                                        {{ $item->category_name }} </a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block justify-end font-heading">
                            <nav>
                                <ul>

                                    <li>
                                        <a class="active" href="{{ url('/') }}">Home </a>

                                    </li>

                                    @php

                                        $categories = App\Models\Category::orderBy('category_name', 'ASC')
                                            ->limit(7)
                                            ->get();
                                    @endphp

                                    @foreach ($categories as $category)
                                        <li>
                                            <a
                                                href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}
                                                <i class="fi-rs-angle-down"></i></a>

                                            @php
                                                $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                                    ->orderBy('subcategory_name', 'ASC')
                                                    ->get();
                                            @endphp

                                            <ul class="sub-menu">
                                                @foreach ($subcategories as $subcategory)
                                                    <li><a
                                                            href="{{ url('product/subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach

                                </ul>
                            </nav>
                        </div>

                        {{-- <div class="hotline d-none d-lg-flex justify-end" style="margin-left: 6rem; ">
                            <a class="" style="font-size: 18px"  href="{{ url('/') }}">
                                Corporate Sales
                            </a>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
        <!-- ******************** End: Desktop Menus ******************** -->

    </div>

</header>
<!-- End Header  -->



<!-- ******************** Mobile Sidebar Menusr ******************** -->
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo"
                        class="custom_logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('product.search') }}" method="post">
                    @csrf
                    <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                        id="search" placeholder="Search for items..." />
                    <div id="searchProducts"></div>
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        @php
                            $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
                        @endphp
                        @foreach ($categories as $category)
                            <li class="menu-item-has-children">
                                <a
                                    href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}</a>
                                @php
                                    $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                        ->orderBy('subcategory_name', 'ASC')
                                        ->get();
                                @endphp
                                <ul class="dropdown">
                                    @foreach ($subcategories as $subcategory)
                                        <li>
                                            <a
                                                href="{{ url('product/subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                @auth
                    <div class="single-mobile-header-info">
                        <a href="{{ route('dashboard') }}"><i class="fi-rs-user"></i>My Account</a>
                    </div>
                @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('login') }}"><i class="fi-rs-user"></i>Login</a>
                        <a href="{{ route('register') }}"><i class="fi-rs-user"></i>Register</a>
                    </div>
                @endauth
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>{{ $setting->support_phone }}</a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="{{ $setting->facebook }}"><img
                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                        alt="" /></a>
                <a href="{{ $setting->twitter }}"><img
                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                        alt="" /></a>
                {{-- <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a> --}}
                <a href="{{ $setting->youtube }}"><img
                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                        alt="" /></a>
            </div>
        </div>
    </div>
</div>
<!-- ******************** End: Mobile Sidebar Menusr ******************** -->


<!-- ******************** News Ticker ******************** -->
<style>
    * {
        box-sizing: border-box;
    }

    @-webkit-keyframes ticker {
        0% {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            visibility: visible;
        }

        100% {
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }
    }

    @keyframes ticker {
        0% {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            visibility: visible;
        }

        100% {
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }
    }

    .ticker-wrap {
        position: relative;
        /* top: 30px; */
        left: 0;
        width: 100%;
        overflow: hidden;
        height: 44px;
        background-color: #b50746;
        box-sizing: content-box;
        margin-top: 20px;
        margin-bottom: 20px;
        /*border-top: 1px #3bb77e solid;*/
        /*border-bottom: 1px #3bb77e solid;*/
    }

    .ticker-wrap .ticker {
        display: inline-block;
        height: 3rem;
        line-height: 3rem;
        white-space: nowrap;
        padding-right: 100%;
        box-sizing: content-box;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
        -webkit-animation-name: ticker;
        animation-name: ticker;
        -webkit-animation-duration: 90s;
        animation-duration: 90s;
    }

    .ticker-wrap .ticker__item {
        display: inline-block;
        padding: 0 2rem;
        font-size: 20px;
        color: #fff;
    }

    .ticker__item:hover {
        color: #000;
        cursor: pointer;
    }

    @media screen and (max-width: 480px) {

        .offer-mbl {
            height: 38px !important;

            padding-left: 0px !important;
            padding-top: 3px !important;
        }

        .off-font {
            font-size: 18px !important;
        }


        .upate-mbl {
            height: 39px !important;
            padding-top: 5px;
            padding-left: 5px !important;
            padding-right: 0px;
            margin: auto;
            background-color: #29a4d1;
            border-top: 1px #29a4d1 solid;
            border-bottom: 1px #29a4d1 solid;
        }

        .font-mbl {
            font-weight: 600 !important;
        }

        .ticker-wrap-mbl {
            position: relative;
            /* top: 30px; */
            left: 0;
            width: 100%;
            overflow: hidden;
            height: 37px;
            background-color: #3bb77e;
            box-sizing: content-box;
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 1px #3bb77e1 solid;
            border-bottom: 1px #3bb77e solid;
        }

        .ticker-wrap .ticker {
            display: inline-block;
            height: 3rem;
            line-height: 2rem;
            white-space: nowrap;
            padding-right: 100%;
            box-sizing: content-box;
            -webkit-animation-iteration-count: infinite;
            animation-iteration-count: infinite;
            -webkit-animation-timing-function: linear;
            animation-timing-function: linear;
            -webkit-animation-name: ticker;
            animation-name: ticker;
            -webkit-animation-duration: 90s;
            animation-duration: 90s;
        }

        .ticker-wrap .ticker__item {
            display: inline-block;
            padding: 0 2rem;
            font-size: 17px;
            color: #fff;
            margin-top: 3px;
        }

    }

    /* Slider */
    .slick-slide {
        margin: 5px 10px;
    }

    .slick-slide img {
        width: 100%;
    }

    .slick-list {
        position: relative;
        display: block;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .slick-list:focus {
        outline: none;
    }

    .slick-list.dragging {
        cursor: pointer;
        cursor: hand;
    }

    .slick-slider .slick-track,
    .slick-slider .slick-list {
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
        -o-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .slick-track {
        position: relative;
        top: 0;
        left: 0;
        display: block;
    }

    .slick-track:before,
    .slick-track:after {
        display: table;
        content: '';
    }

    .slick-track:after {
        clear: both;
    }

    .slick-loading .slick-track {
        visibility: hidden;
    }

    .slick-slide {
        display: none;
        float: left;
        height: 100%;
        min-height: 1px;
    }

    [dir='rtl'] .slick-slide {
        float: right;
    }

    .slick-slide img {
        display: block;
    }

    .slick-slide.slick-loading img {
        display: none;
    }

    .slick-slide.dragging img {
        pointer-events: none;
    }

    .slick-initialized .slick-slide {
        display: block;
    }

    .slick-loading .slick-slide {
        visibility: hidden;
    }

    .slick-vertical .slick-slide {
        display: block;
        height: auto;
        border: 1px solid transparent;
    }

    .slick-arrow.slick-hidden {
        display: none;
    }
</style>

<section>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 vanish offer-mbl"
                style=" height: 45px; padding-top: 7px; padding-left: 20px; padding-right: 0px; margin:auto; background-color: #b50746;">
                <p class="off-font" style="font-weight: 500; font-size: 20px; color:#fff; margin-top:4px;">Offers
                    :</p>
            </div>

            <div class="col-10 col-md-11" style="padding-left: 0px; padding-right: 0px;">
                <div class="Scriptcontent">
                    <div class="ticker-wrap ticker-wrap-mbl">
                        <div class="ticker">
                            @php
                                $newsTicker = App\Models\NewsTicker::orderBy('id', 'ASC')->get();
                            @endphp
                            @foreach ($newsTicker as $item)
                                <div class="ticker__item">
                                    {{ $item->news }}
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<!-- ******************** End: News Ticker ******************** -->
