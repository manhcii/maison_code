<!DOCTYPE html>
<html lang="{{ $locale ?? 'vi' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ $seo_title ?? ($page->title ?? ($web_information->information->seo_title ?? '')) }}
    </title>
    <link rel="icon" href="{{ $web_information->image->favicon ?? '' }}" type="image/x-icon">
    {{-- Print SEO --}}
    @php
        $seo_title = $seo_title ?? ($page->title ?? ($web_information->information->seo_title ?? ''));
        $seo_keyword = $seo_keyword ?? ($page->keyword ?? ($web_information->information->seo_keyword ?? ''));
        $seo_description = $seo_description ?? ($page->description ?? ($web_information->information->seo_description ?? ''));
        $seo_image = $seo_image ?? ($page->json_params->og_image ?? ($web_information->image->seo_og_image ?? ''));
    @endphp
    <meta name="description" content="{{ $seo_description }}" />
    <meta name="keywords" content="{{ $seo_keyword }}" />
    <meta name="news_keywords" content="{{ $seo_keyword }}" />
    <meta property="og:image" content="{{ $seo_image }}" />
    <meta property="og:title" content="{{ $seo_title }}" />
    <meta property="og:description" content="{{ $seo_description }}" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />

    <meta name="copyright" content="{{ $web_information->information->site_name ?? '' }}" />
    <meta name="author" content="{{ $web_information->information->site_name ?? '' }}" />
    <meta name="robots" content="index,follow" />

    {{-- End Print SEO --}}
    {{-- Include style for app --}}
    @include('frontend.panels.styles')
    {{-- Styles custom each page --}}
    @stack('style')
    <style>
        .side-push-panel.side-panel-open.stretched.device-lg .slider-inner,
        .side-push-panel.side-panel-open.stretched.device-xl .slider-inner,
        .side-push-panel.side-panel-open-signup.stretched.device-lg .slider-inner,
        .side-push-panel.side-panel-open-signup.stretched.device-xl .slider-inner {
            left: 0px;
        }

        body.side-push-panel.side-panel-open.stretched #wrapper,
        body.side-push-panel.side-panel-open.stretched #header.sticky-header .container,
        body.side-push-panel.side-panel-open-signup.stretched #wrapper,
        body.side-push-panel.side-panel-open-signup.stretched #header.sticky-header .container {
            right: 0px;
        }
    </style>
    @stack('schema')
</head>

<body class="stretched side-push-panel">
    <div id="wrapper" class="clearfix">

        @include('frontend.blocks.header.styles.default')

        {{-- Foreach and print block content by current page --}}
        @if (isset($blocks_selected))
            @foreach ($blocks_selected as $block)
                @if (\View::exists('frontend.blocks.' . $block->block_code . '.index'))
                    @include('frontend.blocks.' . $block->block_code . '.index')
                @else
                    {{ 'View: frontend.blocks.' . $block->block_code . '.index do not exists!' }}
                @endif
            @endforeach
        @endif
        @include('frontend.blocks.footer.styles.default')
        <div class="backdrop__body-backdrop___1rvky"></div>
    </div>
    <div id="CartDrawer" class="cart-sidebar">
        <div class="clearfix cart_heading">
            <h4 class="cart_title">Giỏ hàng</h4>
            <div class="cart_btn-close" title="Đóng giỏ hàng">
                <svg class="Icon Icon--close" viewBox="0 0 16 14">
                    <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="drawer__inner">
            <div id="CartContainer" class="CartSideContainer">

                @if (session('cart'))
                    <div class="top-cart-content">
                        
                        <div class="top-cart-items">
                            @php $total = 0 @endphp
                            @foreach (session('cart') as $id => $details)
                                @php
                                    
                                    $total += $details['price'] * $details['quantity'];
                                    $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $details['title'], $id, 'detail', 'san-pham');
                                @endphp
                                <div class="top-cart-item">
                                    <div class="top-cart-item-image">
                                        <a href="{{ $alias }}"><img
                                                src="{{ $details['image_thumb'] ?? $details['image'] }}"
                                                alt="{{ $details['title'] }}"></a>
                                    </div>
                                    <div class="top-cart-item-desc">
                                        <div class="top-cart-item-desc-title">
                                            <a href="{{ $alias }}">{{ $details['title'] }}</a>
                                            <span
                                                class="top-cart-item-price d-block">{{ isset($details['price']) && $details['price'] > 0 ? number_format($details['price'], 2) . ' $' : __('Contact') }}</span>
                                        </div>
                                        <div class="top-cart-item-quantity">x {{ $details['quantity'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="top-cart-action">
                            <span class="top-checkout-price">${{ number_format($total, 2) }}</span>
                            <a href="{{ route('frontend.order.cart') }}"
                                class="button button-3d button-small m-0">@lang('View cart')</a>
                        </div>
                    </div>
                    @php $total = 0 @endphp
                    <form action="/cart" method="post" novalidate="" class="cart ajaxcart">
                        <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items">
                           
                            @foreach (session('cart') as $id => $details)
                                @php
                                    
                                    $total += $details['price'] * $details['quantity'];
                                    $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $details['title'], $id, 'detail', 'san-pham');
                                @endphp
                                <div class="ajaxcart__row">
                                    <div class="ajaxcart__product cart_product" data-line="1">
                                        <a href="{{$alias}}" class="ajaxcart__product-image cart_image" title="{{ $details['title'] }}"><img width="80" height="80" src="{{ $details['image_thumb'] ?? $details['image'] }}" alt="{{ $details['title'] }}"></a>
                                        <div class="grid__item cart_info">
                                            <div class="ajaxcart__product-name-wrapper cart_name">
                                                <a href="{{$alias}}" class="ajaxcart__product-name h4" title="{{ $details['title'] }}">{{ $details['title'] }}</a>
                                            </div>
                                            <div class="grid">
                                                <div class="grid__item one-half cart_select cart_item_name">
                                                <label class="cart_quantity">Số lượng</label>
                                                    <div class="ajaxcart__qty input-group-btn">
                                                        {{ $details['quantity'] }}
                                                    </div>
                                                </div>
                                                <div class="grid__item one-half text-right cart_prices">
                                                    <span class="cart-price">{{ isset($details['price']) && $details['price'] > 0 ? number_format($details['price'], '0',',','.') :"0"}}₫</span>
                                                    <a class="cart__btn-remove remove-from-cart ajaxifyCart--remove" href="javascript:;" data-id="{{$id}}">Xóa</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                            <div class="ajaxcart__subtotal">
                                <div class="cart__subtotal">
                                    <div class="cart__col-6">Tổng tiền:</div>
                                    <div class="text-right cart__totle"><span class="total-price">{{number_format($total, '0',',','.')}}₫</span></div>
                                </div>
                            </div>
                            <div class="cart__btn-proceed-checkout-dt">
                                <button onclick="location.href='{{ route('frontend.order.cart') }}'" type="button" class="button btn btn-default cart__btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Đặt hàng</button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="cart--empty-message">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 201.387 201.387"
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

    {{-- Include fixed alert --}}
    @include('frontend.components.sticky.alert')
    {{-- Include scripts --}}
    @include('frontend.panels.scripts')
    {{-- Scripts custom each page --}}
    @stack('script')
    {{-- Include sticky contact --}}
    @include('frontend.components.sticky.contact')

    {{-- Include popup --}}
    @include('frontend.components.popup.default')

</body>

</html>
