@extends('frontend.layouts.default')

@php
    $page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
    $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
    
@endphp
@push('style')
    <style>
        .breadcrumb_background {
            background-image: url({{ $image_background }});
            position: relative;
            justify-content: center;
            text-align: center;
            align-items: center;
            min-height: 202px;
            flex-flow: column;
            display: flex;
            position: relative;
            padding-top: 30px
        }
    </style>
@endpush
@section('content')
    {{-- Print all content by [module - route - page] without blocks content at here --}}
    <div class="bodywrap">
        <div class="breadcrumb_background">
            <section class="bread-crumb">
                <span class="crumb-border"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 a-left">
                            <ul class="breadcrumb">
                                <li class="home">
                                    <a href="/"><span>Trang chủ</span></a>
                                    <span class="mr_lr"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path
                                                d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z" />
                                        </svg></span>
                                </li>

                                <li>
                                    <strong><span>Giỏ hàng</span></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <div class="title_full">
                <div class="container a-center">
                    <h1 class="title_page">Giỏ hàng</h1>
                </div>
            </div>
        </div>
        <section class="main-cart-page main-container col1-layout">
            <div class="main container cartpcstyle">
                <div class="wrap_background_aside">
                    <div class="header-cart">
                        <div class="title-block-page">
                            <h1 class="title_cart">
                                <span>Giỏ hàng của bạn</span>
                            </h1>
                        </div>
                    </div>
                    @if ($agent->isDesktop())
                        <div class="cart-page d-xl-block d-none container">
                            <div class="drawer__inner">
                                <div class="CartPageContainer">
                                    @if (session('cart'))
                                        <div class="cart-header-info">
                                            <div>Sản phẩm</div>
                                            <div>Đơn giá</div>
                                            <div>Số lượng</div>
                                            <div>Thành tiền</div>
                                        </div>
                                        <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items">
                                            <div class="ajaxcart__row">
                                                @php $total = 0 @endphp
                                                @foreach (session('cart') as $id => $details)
                                                    @php
                                                        $title = $details['title'];
                                                        $total += $details['price'] * $details['quantity'];
                                                        $alias_detail = Str::slug($details['title']);
                                                        $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $id, 'detail', 'san-pham');
                                                    @endphp
                                                    <div class="ajaxcart__product cart_product">
                                                        <a href="{{ $url_link }}"
                                                            class="ajaxcart__product-image cart_image"
                                                            title="{{ $details['title'] }}"><img
                                                                src="{{ $details['image_thumb'] ?? $details['image'] }}"
                                                                alt="{{ $details['title'] }}"></a>
                                                        <div class="grid__item cart_info">
                                                            <div class="ajaxcart__product-name-wrapper cart_name">
                                                                <a href="{{ $url_link }}"
                                                                    class="ajaxcart__product-name h4"
                                                                    title="{{ $details['title'] }}">{{ $details['title'] }}</a>
                                                                <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove remove-from-cart"
                                                                    href="javascript:void(0)"
                                                                    data-id="{{ $id }}">Xóa</a>

                                                            </div>
                                                            <div class="grid">
                                                                <div class="grid__item one-half text-right cart_prices">
                                                                    <span
                                                                        class="cart-price">{{ isset($details['price']) && $details['price'] > 0 ? number_format($details['price'], 0, ',', '.') : '0' }}₫</span>
                                                                </div>
                                                            </div>
                                                            <div class="grid">
                                                                <div
                                                                    class="grid__item one-half cart_select cart-product-quantity">
                                                                    <div class="ajaxcart__qty input-group-btn quantity"
                                                                        data-id="{{ $id }}">
                                                                        <button type="button"
                                                                            class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count minus"
                                                                            onClick="var result = document.getElementById('qtym_{{ $id }}'); var qtypro = result.value; if( !isNaN( qtypro ) &amp;&amp; qtypro &gt; 1 ) result.value--;updatecart(this);  return false;">
                                                                            -
                                                                        </button>
                                                                        <input type="text" id="qtym_{{ $id }}"
                                                                            onchange="updatecart(this)" name="quantity"
                                                                            class="ajaxcart__qty-num number-sidebar plus update-cart"
                                                                            maxlength="3"
                                                                            value="{{ $details['quantity'] }}"
                                                                            min="0" data-id="" data-line="1"
                                                                            aria-label="quantity" pattern="[0-9]*">
                                                                        <button type="button"
                                                                            class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count plus"
                                                                            onClick="var result = document.getElementById('qtym_{{ $id }}'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;updatecart(this);  return false;">
                                                                            +
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="grid">
                                                                <div class="grid__item one-half text-right cart_prices">
                                                                    <span
                                                                        class="cart-price cart-price-total">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}₫</span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                                            <div class="row">

                                                <div class="col-lg-8 col-12 offset-md-4 offset-lg-4 offset-xl-4 tt_right">
                                                    <div class="ajaxcart__subtotal">
                                                        <div class="cart__subtotal">
                                                            <div class="cart__col-6">Tổng thanh toán:</div>
                                                            <div class="text-right cart__totle"><span
                                                                    class="total-price">{{ number_format($total, 0, ',', '.') }}₫</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="cart__btn-proceed-checkout-dt">
                                                    <button onclick="location.href='/checkout'" type="button"
                                                        class="button btn btn-default cart__btn-proceed-checkout"
                                                        id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                                                </div> --}}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row col-mb-30">
                                            <div class="col-lg-12 article-main">
                                                <h4 class="text-center title-form-coment">@lang('Submit Order Cart')
                                                </h4>
                                                <form method="POST" action="{{ route('frontend.order.store.product') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group padding-0">
                                                                <label for="name">@lang('Fullname') <small
                                                                        class="text-danger">*</small></label>
                                                                <input type="text" class="sm-form-control"
                                                                    placeholder="@lang('Fullname') *" id="name"
                                                                    name="name" required
                                                                    value="{{ $user_auth->name ?? old('name') }}" />
                                                            </div>

                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group padding-0">
                                                                <label for="email">@lang('Email')</label>
                                                                <input type="email" class="sm-form-control"
                                                                    placeholder="@lang('Email')" id="email"
                                                                    name="email" value="{{ old('email') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group padding-0">
                                                                <label for="phone">@lang('Phone') <small
                                                                        class="text-danger">*</small></label>
                                                                <input type="text" class="sm-form-control"
                                                                    placeholder="@lang('Phone') *" id="phone"
                                                                    name="phone" required
                                                                    value="{{ $user_auth->phone ?? old('phone') }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group padding-0">
                                                                <label for="address">@lang('Address')</label>
                                                                <input type="text" class="sm-form-control"
                                                                    placeholder="@lang('Address')" id="address"
                                                                    name="address" value="{{ old('address') }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 form-group">
                                                            <label for="customer_note">@lang('Content note')</label>
                                                            <textarea class="sm-form-control" id="customer_note" name="customer_note" rows="5" cols="30"
                                                                placeholder="@lang('Content note')" autocomplete="off">{{ old('customer_note') }}</textarea>
                                                        </div>
                                                        <div class="col-12 form-group">
                                                            <button type="submit"
                                                                class="btn btn-primary button_45">@lang('Submit Order')</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="cart--empty-message"><svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                x="0px" y="0px" viewBox="0 0 201.387 201.387"
                                                style="enable-background:new 0 0 201.387 201.387;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M129.413,24.885C127.389,10.699,115.041,0,100.692,0C91.464,0,82.7,4.453,77.251,11.916    c-1.113,1.522-0.78,3.657,0.742,4.77c1.517,1.109,3.657,0.78,4.768-0.744c4.171-5.707,10.873-9.115,17.93-9.115    c10.974,0,20.415,8.178,21.963,19.021c0.244,1.703,1.705,2.932,3.376,2.932c0.159,0,0.323-0.012,0.486-0.034    C128.382,28.479,129.679,26.75,129.413,24.885z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M178.712,63.096l-10.24-17.067c-0.616-1.029-1.727-1.657-2.927-1.657h-9.813c-1.884,0-3.413,1.529-3.413,3.413    s1.529,3.413,3.413,3.413h7.881l6.144,10.24H31.626l6.144-10.24h3.615c1.884,0,3.413-1.529,3.413-3.413s-1.529-3.413-3.413-3.413    h-5.547c-1.2,0-2.311,0.628-2.927,1.657l-10.24,17.067c-0.633,1.056-0.648,2.369-0.043,3.439s1.739,1.732,2.97,1.732h150.187    c1.231,0,2.364-0.662,2.97-1.732S179.345,64.15,178.712,63.096z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M161.698,31.623c-0.478-0.771-1.241-1.318-2.123-1.524l-46.531-10.883c-0.881-0.207-1.809-0.053-2.579,0.423    c-0.768,0.478-1.316,1.241-1.522,2.123l-3.509,15c-0.43,1.835,0.71,3.671,2.546,4.099c1.835,0.43,3.673-0.71,4.101-2.546    l2.732-11.675l39.883,9.329l-6.267,26.795c-0.43,1.835,0.71,3.671,2.546,4.099c0.263,0.061,0.524,0.09,0.782,0.09    c1.55,0,2.953-1.062,3.318-2.635l7.045-30.118C162.328,33.319,162.176,32.391,161.698,31.623z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M102.497,39.692l-3.11-26.305c-0.106-0.899-0.565-1.72-1.277-2.28c-0.712-0.56-1.611-0.816-2.514-0.71l-57.09,6.748    c-1.871,0.222-3.209,1.918-2.988,3.791l5.185,43.873c0.206,1.737,1.679,3.014,3.386,3.014c0.133,0,0.27-0.009,0.406-0.024    c1.87-0.222,3.208-1.918,2.988-3.791l-4.785-40.486l50.311-5.946l2.708,22.915c0.222,1.872,1.91,3.202,3.791,2.99    C101.379,43.261,102.717,41.564,102.497,39.692z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M129.492,63.556l-6.775-28.174c-0.212-0.879-0.765-1.64-1.536-2.113c-0.771-0.469-1.696-0.616-2.581-0.406L63.613,46.087    c-1.833,0.44-2.961,2.284-2.521,4.117l3.386,14.082c0.44,1.835,2.284,2.964,4.116,2.521c1.833-0.44,2.961-2.284,2.521-4.117    l-2.589-10.764l48.35-11.626l5.977,24.854c0.375,1.565,1.775,2.615,3.316,2.615c0.265,0,0.533-0.031,0.802-0.096    C128.804,67.232,129.932,65.389,129.492,63.556z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M179.197,64.679c-0.094-1.814-1.592-3.238-3.41-3.238H25.6c-1.818,0-3.316,1.423-3.41,3.238l-6.827,133.12    c-0.048,0.934,0.29,1.848,0.934,2.526c0.645,0.677,1.539,1.062,2.475,1.062h163.84c0.935,0,1.83-0.384,2.478-1.062    c0.643-0.678,0.981-1.591,0.934-2.526L179.197,64.679z M22.364,194.56l6.477-126.293h143.701l6.477,126.293H22.364z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M126.292,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C136.532,79.686,131.939,75.093,126.292,75.093z M126.292,88.747c-1.883,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    c1.882,0,3.413,1.531,3.413,3.413S128.174,88.747,126.292,88.747z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M75.092,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C85.332,79.686,80.739,75.093,75.092,75.093z M75.092,88.747c-1.882,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    s3.413,1.531,3.413,3.413S76.974,88.747,75.092,88.747z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M126.292,85.333h-0.263c-1.884,0-3.413,1.529-3.413,3.413c0,0.466,0.092,0.911,0.263,1.316v17.457    c0,12.233-9.953,22.187-22.187,22.187s-22.187-9.953-22.187-22.187V88.747c0-1.884-1.529-3.413-3.413-3.413    s-3.413,1.529-3.413,3.413v18.773c0,15.998,13.015,29.013,29.013,29.013s29.013-13.015,29.013-29.013V88.747    C129.705,86.863,128.176,85.333,126.292,85.333z">
                                                        </path>
                                                    </g>
                                                </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                            </svg>
                                            <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    @else
                        <div class="cart-mobile-page d-block d-xl-none">
                            <div class="CartMobileContainer">
                                @if (session('cart'))
                                    <div class="cart ajaxcart cart-mobile">
                                        <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body">
                                            @php $total = 0 @endphp
                                            @foreach (session('cart') as $id => $details)
                                                @php
                                                    $title = $details['title'];
                                                    $total += $details['price'] * $details['quantity'];
                                                    $alias_detail = Str::slug($details['title']);
                                                    $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $id, 'detail', 'san-pham');
                                                @endphp
                                                <div class="ajaxcart__row">
                                                    <div class="ajaxcart__product cart_product">
                                                        <a href="{{ $url_link }}"
                                                            class="ajaxcart__product-image cart_image"
                                                            title="{{ $details['title'] }}"><img
                                                                src="{{ $details['image_thumb'] ?? $details['image'] }}"
                                                                alt="{{ $details['title'] }}"></a>
                                                        <div class="grid__item cart_info">
                                                            <div class="ajaxcart__product-name-wrapper cart_name">
                                                                <a href="{{ $url_link }}"
                                                                    class="ajaxcart__product-name h4"
                                                                    title="{{ $details['title'] }}">{{ $details['title'] }}</a>
                                                                

                                                            </div>
                                                            <div class="grid">
                                                                <div class="grid__item one-half cart_select cart_item_name">
                                                                    <div class="ajaxcart__qty input-group-btn quantity"
                                                                        data-id="{{ $id }}">
                                                                        <button type="button"
                                                                            class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count minus"
                                                                            onClick="var result = document.getElementById('qtym_{{ $id }}'); var qtypro = result.value; if( !isNaN( qtypro ) &amp;&amp; qtypro &gt; 1 ) result.value--;updatecart(this); return false;">
                                                                            -
                                                                        </button>
                                                                        <input type="text" id="qtym_{{ $id }}"
                                                                            onchange="updatecart(this)" name="quantity"
                                                                            class="ajaxcart__qty-num number-sidebar plus update-cart"
                                                                            maxlength="3"
                                                                            value="{{ $details['quantity'] }}"
                                                                            min="0" data-id="" data-line="1"
                                                                            aria-label="quantity" pattern="[0-9]*">
                                                                        <button type="button"
                                                                            class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count plus"
                                                                            onClick="var result = document.getElementById('qtym_{{ $id }}'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;updatecart(this);  return false;">
                                                                            +
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="grid__item one-half text-right cart_prices">
                                                                    <span class="cart-price cart-price-total">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}₫</span>
                                                                    <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove remove-from-cart"
                                                                    href="javascript:void(0)"
                                                                    data-id="{{ $id }}">Xóa</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>

                                        <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                                            <div class="row">

                                                <div class="col-lg-8 col-12 offset-md-4 offset-lg-4 offset-xl-4 tt_right">
                                                    <div class="ajaxcart__subtotal">
                                                        <div class="cart__subtotal">
                                                            <div class="cart__col-6">Tổng thanh toán:</div>
                                                            <div class="text-right cart__totle"><span
                                                                    class="total-price">{{ number_format($total, 0, ',', '.') }}₫</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="cart__btn-proceed-checkout-dt">
                                                    <button onclick="location.href='/checkout'" type="button"
                                                        class="button btn btn-default cart__btn-proceed-checkout"
                                                        id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                                                </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-mb-30">
                                        <div class="col-lg-12 article-main">
                                            <h4 class="text-center title-form-coment">@lang('Submit Order Cart')
                                            </h4>
                                            <form method="POST" action="{{ route('frontend.order.store.product') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group padding-0">
                                                            <label for="name">@lang('Fullname') <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="text" class="sm-form-control"
                                                                placeholder="@lang('Fullname') *" id="name"
                                                                name="name" required
                                                                value="{{ $user_auth->name ?? old('name') }}" />
                                                        </div>

                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group padding-0">
                                                            <label for="email">@lang('Email')</label>
                                                            <input type="email" class="sm-form-control"
                                                                placeholder="@lang('Email')" id="email"
                                                                name="email" value="{{ old('email') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group padding-0">
                                                            <label for="phone">@lang('Phone') <small
                                                                    class="text-danger">*</small></label>
                                                            <input type="text" class="sm-form-control"
                                                                placeholder="@lang('Phone') *" id="phone"
                                                                name="phone" required
                                                                value="{{ $user_auth->phone ?? old('phone') }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                        <div class="form-group padding-0">
                                                            <label for="address">@lang('Address')</label>
                                                            <input type="text" class="sm-form-control"
                                                                placeholder="@lang('Address')" id="address"
                                                                name="address" value="{{ old('address') }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <label for="customer_note">@lang('Content note')</label>
                                                        <textarea class="sm-form-control" id="customer_note" name="customer_note" rows="5" cols="30"
                                                            placeholder="@lang('Content note')" autocomplete="off">{{ old('customer_note') }}</textarea>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <button type="submit"
                                                            class="btn btn-primary button_45">@lang('Submit Order')</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="cart--empty-message"><svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                            x="0px" y="0px" viewBox="0 0 201.387 201.387"
                                            style="enable-background:new 0 0 201.387 201.387;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M129.413,24.885C127.389,10.699,115.041,0,100.692,0C91.464,0,82.7,4.453,77.251,11.916    c-1.113,1.522-0.78,3.657,0.742,4.77c1.517,1.109,3.657,0.78,4.768-0.744c4.171-5.707,10.873-9.115,17.93-9.115    c10.974,0,20.415,8.178,21.963,19.021c0.244,1.703,1.705,2.932,3.376,2.932c0.159,0,0.323-0.012,0.486-0.034    C128.382,28.479,129.679,26.75,129.413,24.885z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M178.712,63.096l-10.24-17.067c-0.616-1.029-1.727-1.657-2.927-1.657h-9.813c-1.884,0-3.413,1.529-3.413,3.413    s1.529,3.413,3.413,3.413h7.881l6.144,10.24H31.626l6.144-10.24h3.615c1.884,0,3.413-1.529,3.413-3.413s-1.529-3.413-3.413-3.413    h-5.547c-1.2,0-2.311,0.628-2.927,1.657l-10.24,17.067c-0.633,1.056-0.648,2.369-0.043,3.439s1.739,1.732,2.97,1.732h150.187    c1.231,0,2.364-0.662,2.97-1.732S179.345,64.15,178.712,63.096z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M161.698,31.623c-0.478-0.771-1.241-1.318-2.123-1.524l-46.531-10.883c-0.881-0.207-1.809-0.053-2.579,0.423    c-0.768,0.478-1.316,1.241-1.522,2.123l-3.509,15c-0.43,1.835,0.71,3.671,2.546,4.099c1.835,0.43,3.673-0.71,4.101-2.546    l2.732-11.675l39.883,9.329l-6.267,26.795c-0.43,1.835,0.71,3.671,2.546,4.099c0.263,0.061,0.524,0.09,0.782,0.09    c1.55,0,2.953-1.062,3.318-2.635l7.045-30.118C162.328,33.319,162.176,32.391,161.698,31.623z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M102.497,39.692l-3.11-26.305c-0.106-0.899-0.565-1.72-1.277-2.28c-0.712-0.56-1.611-0.816-2.514-0.71l-57.09,6.748    c-1.871,0.222-3.209,1.918-2.988,3.791l5.185,43.873c0.206,1.737,1.679,3.014,3.386,3.014c0.133,0,0.27-0.009,0.406-0.024    c1.87-0.222,3.208-1.918,2.988-3.791l-4.785-40.486l50.311-5.946l2.708,22.915c0.222,1.872,1.91,3.202,3.791,2.99    C101.379,43.261,102.717,41.564,102.497,39.692z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M129.492,63.556l-6.775-28.174c-0.212-0.879-0.765-1.64-1.536-2.113c-0.771-0.469-1.696-0.616-2.581-0.406L63.613,46.087    c-1.833,0.44-2.961,2.284-2.521,4.117l3.386,14.082c0.44,1.835,2.284,2.964,4.116,2.521c1.833-0.44,2.961-2.284,2.521-4.117    l-2.589-10.764l48.35-11.626l5.977,24.854c0.375,1.565,1.775,2.615,3.316,2.615c0.265,0,0.533-0.031,0.802-0.096    C128.804,67.232,129.932,65.389,129.492,63.556z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M179.197,64.679c-0.094-1.814-1.592-3.238-3.41-3.238H25.6c-1.818,0-3.316,1.423-3.41,3.238l-6.827,133.12    c-0.048,0.934,0.29,1.848,0.934,2.526c0.645,0.677,1.539,1.062,2.475,1.062h163.84c0.935,0,1.83-0.384,2.478-1.062    c0.643-0.678,0.981-1.591,0.934-2.526L179.197,64.679z M22.364,194.56l6.477-126.293h143.701l6.477,126.293H22.364z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M126.292,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C136.532,79.686,131.939,75.093,126.292,75.093z M126.292,88.747c-1.883,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    c1.882,0,3.413,1.531,3.413,3.413S128.174,88.747,126.292,88.747z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M75.092,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C85.332,79.686,80.739,75.093,75.092,75.093z M75.092,88.747c-1.882,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    s3.413,1.531,3.413,3.413S76.974,88.747,75.092,88.747z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M126.292,85.333h-0.263c-1.884,0-3.413,1.529-3.413,3.413c0,0.466,0.092,0.911,0.263,1.316v17.457    c0,12.233-9.953,22.187-22.187,22.187s-22.187-9.953-22.187-22.187V88.747c0-1.884-1.529-3.413-3.413-3.413    s-3.413,1.529-3.413,3.413v18.773c0,15.998,13.015,29.013,29.013,29.013s29.013-13.015,29.013-29.013V88.747    C129.705,86.863,128.176,85.333,126.292,85.333z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                            <g> </g>
                                        </svg>
                                        <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
    {{-- End content --}}
@endsection
