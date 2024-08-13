@extends('frontend.layouts.default')

@php
    $title = $detail->json_params->title->{$locale} ?? $detail->title;
    $brief = $detail->json_params->brief->{$locale} ?? 'Mô tả đang cập nhật';
    $price = $detail->json_params->price ?? null;
    $content = $detail->json_params->content->{$locale} ?? null;
    $image = $detail->image != '' ? $detail->image : null;
    $image_thumb = $detail->image_thumb != '' ? $detail->image_thumb : null;
    $date = date('H:i d/m/Y', strtotime($detail->created_at));
    // For taxonomy
    $taxonomy_json_params = json_decode($detail->taxonomy_json_params);
    $taxonomy_title = $taxonomy_json_params->title->{$locale} ?? $detail->taxonomy_title;
    $image_background = $taxonomy_json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? null);
    $taxonomy_alias = Str::slug($taxonomy_title);
    $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $taxonomy_alias, $detail->taxonomy_id);
    
    $seo_title = $detail->json_params->seo_title ?? $title;
    $seo_keyword = $detail->json_params->seo_keyword ?? null;
    $seo_description = $detail->json_params->seo_description ?? $brief;
    $seo_image = $image ?? ($image_thumb ?? null);
    $image_product_screen = null;
    if ($agent->isDesktop() && $image != null) {
        $image_product_screen = $image;
    } else {
        $image_product_screen = $image_thumb;
    }
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
    <div class="breadcrumb_background">
        <div class="title_full">
            <div class="container a-center">
                <p class="title_page">{{ $title }}</p>
            </div>
        </div>
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
                                <a class="changeurl" href="{{ $alias_category }}"><span>{{ $taxonomy_title }}</span></a>
                                <span class="mr_lr"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path
                                            d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z" />
                                    </svg></span>
                            </li>

                            <li>
                                <strong><span>{{ $title }}</span></strong>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="product layout-product">
        <div class="product-page">
            <div class="product_top details-product">
                <div class="container">
                    <div class="row">
                        <div class="product-detail-left product-images col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="product-image-block relative clearfix">
                                <div class="swiper-container gallery-top col_large_default large-image">
                                    <div class="swiper-wrapper" id="lightgallery" data-lightbox="gallery">
                                        <a class="swiper-slide grid-item" href="{{ $image_product_screen }}" data-lightbox="gallery-item"
                                            title="Click để xem">
                                            <img height="540" width="540" src="{{ $image_product_screen }}"
                                                alt="{{ $title }}" data-image="{{ $image_product_screen }}"
                                                class="img-product img-responsive mx-auto d-block swiper-lazy" />
                                        </a>
                                        @isset($detail->json_params->gallery_image)
                                            @foreach ($detail->json_params->gallery_image as $value)
                                                <a class="swiper-slide grid-item" href="{{ $value }}" data-lightbox="gallery-item"
                                                    title="Click để xem">
                                                    <img height="540" width="540" src="{{ $value }}"
                                                        alt="{{ $title }}" data-image="{{ $value }}"
                                                        class="img-product img-responsive mx-auto d-block swiper-lazy" />
                                                </a>
                                            @endforeach
                                        @endisset

                                    </div>
                                </div>

                                <div class="swiper_thumbs">
                                    <div class="swiper-container gallery-thumbs">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="p-100">
                                                    <img height="80" width="80" src="{{ $image_product_screen }}"
                                                        alt="{{ $title }}" data-image="{{ $image_product_screen }}"
                                                        class="swiper-lazy" />
                                                </div>
                                            </div>

                                            @isset($detail->json_params->gallery_image)
                                                @foreach ($detail->json_params->gallery_image as $value)
                                                    <div class="swiper-slide">
                                                        <div class="p-100">
                                                            <img height="80" width="80"
                                                                src="{{ $value }}"
                                                                alt="{{$title}}"
                                                                data-image="{{ $value }}"
                                                                class="swiper-lazy" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset

                                           


                                        </div>
                                    </div>

                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                        <div class="details-pro col-12 col-md-6 col-lg-6 col-xl-6">
                            <h1 class="title-product">
                                {{ $title }}
                            </h1>
                            <div class="inventory_quantity">
                                <span class="mb-break">
                                    <span class="stock-brand-title">Thương hiệu:</span>
                                    <span class="a-vendor"> {{ $detail->json_params->brand ?? 'Đang cập nhật' }} </span>
                                </span>
                                <span class="line">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                <span class="mb-break">
                                    <span class="stock-brand-title">Tình trạng:</span>
                                    <span class="a-stock"> {{ $detail->status == 'active' ? 'Còn hàng' : 'Hết hàng' }}
                                    </span>
                                </span>
                            </div>
                                <div class="price-box clearfix">
                                    <span class="special-price">
                                        <span
                                            class="price product-price">{{ $price ? number_format($price, 0, ',', '.') : '0' }}₫</span>
                                    </span>

                                </div>

                                <div class="form-product">
                                    <div class="box-variant clearfix">
                                        <input type="hidden" id="one_variant" name="variantId" value="60522488" />
                                    </div>
                                    <div class="clearfix form-group">
                                        <div class="custom custom-btn-number show">
                                            <label class="sl section">Số lượng:</label>
                                            <div class="input_number_product form-control">
                                                <button class="btn_num num_1 button button_qty"
                                                    onClick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro ) &amp;&amp; qtypro &gt; 1 ) result.value--;return false;"
                                                    type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M400 288h-352c-17.69 0-32-14.32-32-32.01s14.31-31.99 32-31.99h352c17.69 0 32 14.3 32 31.99S417.7 288 400 288z" />
                                                    </svg>
                                                </button>
                                                <input type="text" id="qtym" name="quantity" value="1"
                                                    maxlength="3" class="form-control prd_quantity"
                                                    onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"
                                                    onchange="if(this.value == 0)this.value=1;" />
                                                <button class="btn_num num_2 button button_qty"
                                                    onClick="var result = document.getElementById('qtym'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;return false;"
                                                    type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-summary">
                                        <div class="rte">
                                            {!! $brief !!}
                                        </div>
                                    </div>
                                    <div class="clearfix form-group">
                                        <div class="flex-quantity">
                                            <div class="btn-mua button_actions clearfix">
                                                <button type="button" class="btn fast btn_base btn-buy-now btn-cart" data-id="{{$detail->id}}">
                                                    <span class="txt-main text_1">Mua ngay</span>
                                                    <span class="regular">Giao hàng tận nay quý khách</span>
                                                </button>
                                                <button type="submit"
                                                    class="btn btn_base normal_button btn_add_cart add_to_cart btn-cart" data-id="{{$detail->id}}">
                                                    <span class="txt-main text_1">Cho vào giỏ</span>
                                                    <span class="regular">Thêm vào giỏ để chọn tiếp</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product_bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-12">
                            <div class="product-tab e-tabs not-dqtab">
                                <ul class="tabs tabs-title clearfix">
                                    <li class="tab-link active" data-tab="#tab-1">
                                        <h3><span>Mô tả sản phẩm</span></h3>
                                    </li>
                                </ul>
                                <div class="tab-float">
                                    <div id="tab-1" class="tab-content active content_extab">
                                        <div class="rte product_getcontent">
                                            <div id="content">
                                                {!! $content !!}
                                            </div>
                                            <div class="read-more">
                                                <span>Xem thêm
                                                    <svg aria-hidden="true" focusable="false" data-prefix="far"
                                                        data-icon="chevron-down" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                        class="svg-inline--fa fa-chevron-down fa-w-14">
                                                        <path fill="currentColor"
                                                            d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"
                                                            class=""></path>
                                                    </svg></span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @isset($relatedPosts)
                <div class="product_related">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-12">
                                <div class="productRelate">
                                    <div class="block-title">
                                        <h2>
                                            Sản phẩm tương tự
                                        </h2>
                                    </div>

                                    <div class="swiper_relate">
                                        <div class="product-relate-swiper swiper-container">
                                            <div class="swiper-wrapper">
                                                @foreach ($relatedPosts as $item)
                                                    @php
                                                        $title_item = $item->json_params->title->{$locale} ?? $item->title;
                                                        $price = $item->json_params->price ?? '';
                                                        $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                                                        // Viet ham xu ly lay slug
                                                        $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item->alias ?? $title_item, $item->id, 'detail', $item->taxonomy_title);
                                                    @endphp
                                                    <div class="swiper-slide">
                                                        <div class="item_product_main">
                                                            <div class="wishItem variants product-box product-block-item">
                                                                <div class="product-thumbnail">
                                                                    <a class="image_thumb scale_hover product-transition"
                                                                        href="{{ $alias }}"
                                                                        title="{{ $title }}">
                                                                        <img class="lazyload"
                                                                            src="{{ asset('images/load.gif') }}"
                                                                            data-src="{{ $image }}"
                                                                            alt="{{ $title }}" />
                                                                    </a>
                                                                </div>
                                                                <div class="product-info">
                                                                    <div class="product-content">
                                                                        <h3 class="product-name">
                                                                            <a href="{{ $alias }}"
                                                                                title="{{ $title }}">{{ $title }}</a>
                                                                        </h3>
                                                                        <div class="blockprice">
                                                                            <div class="price-box">
                                                                                {{ $price ? number_format($price, 0, ',', '.') : '0' }}₫
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="product-action d-xl-flex d-none">

                                                                    <button
                                                                        class="cart-button btn-buy firstb btn-cart button_35 left-to muangay btn-cart btn-views add-to-cart" 
                                                                        data-id="{{ $item->id }}" data-quantity="1" title="Mua hàng">
                                                                        <svg width="29" height="29"
                                                                            viewBox="0 0 29 29" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M19.9381 25.6016C19.9381 27.4755 21.4626 29 23.3365 29C25.2104 29 26.735 27.4755 26.735 25.6016C26.735 23.7277 25.2104 22.2031 23.3365 22.2031C21.4626 22.2031 19.9381 23.7277 19.9381 25.6016ZM23.3365 24.4688C23.9612 24.4688 24.4693 24.9769 24.4693 25.6016C24.4693 26.2262 23.9612 26.7344 23.3365 26.7344C22.7119 26.7344 22.2037 26.2262 22.2037 25.6016C22.2037 24.9769 22.7119 24.4688 23.3365 24.4688ZM6.57091 25.6016C6.57091 27.4755 8.09545 29 9.96935 29C11.8432 29 13.3678 27.4755 13.3678 25.6016C13.3678 23.7277 11.8432 22.2031 9.96935 22.2031C8.09545 22.2031 6.57091 23.7277 6.57091 25.6016ZM9.96935 24.4688C10.594 24.4688 11.1022 24.9769 11.1022 25.6016C11.1022 26.2262 10.594 26.7344 9.96935 26.7344C9.34471 26.7344 8.83653 26.2262 8.83653 25.6016C8.83653 24.9769 9.34471 24.4688 9.96935 24.4688ZM13.3678 11.1016H11.1022V17.6719H13.3678V11.1016ZM6.57091 6.57031V3.39844C6.57091 1.52454 5.04637 0 3.17247 0H0.00195312V2.26562H3.17241C3.79705 2.26562 4.30522 2.7738 4.30522 3.39844V16.5391C4.30522 19.6622 6.84612 22.2031 9.96929 22.2031H23.3365C26.4596 22.2031 29.0005 19.6622 29.0005 16.5391V6.57031H6.57091ZM26.735 16.5391C26.735 18.413 25.2104 19.9375 23.3365 19.9375H9.96935C8.09545 19.9375 6.57091 18.413 6.57091 16.5391V8.83594H26.735V16.5391ZM17.899 11.1016H15.6334V17.6719H17.899V11.1016ZM22.4303 11.1016H20.1647V17.6719H22.4303V11.1016Z"
                                                                                fill="#A1CCA3" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
        {{-- End content --}}
    @endsection
