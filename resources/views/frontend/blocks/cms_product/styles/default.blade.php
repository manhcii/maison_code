@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $image = $block->image != '' ? $block->image : url('demos/barber/images/icons/comb3.svg');
        $background = $block->image_background != '' ? $block->image_background : url('demos/seo/images/sections/5.jpg');
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
        
        $params['status'] = App\Consts::TAXONOMY_STATUS['active'];
        $params['taxonomy'] = App\Consts::TAXONOMY['product'];
        // $params['is_featured'] = true;
        $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params)->get();
        $rows[0] = App\Http\Services\ContentService::getCmsPost($params)
            ->limit(12)
            ->get();
        
        $arr_id = [];
        foreach ($taxonomys as $val) {
            //lấy mảng id theo danh mục cha
            if ($val->is_featured == 1) {
                $arr_id[$val->id] = [$val->id];
                foreach ($taxonomys as $val_chil) {
                    if ($val_chil->parent_id == $val->id) {
                        array_push($arr_id[$val->id], $val_chil->id);
                    }
                }
            }
        }
        
        // lấy danh sách sản phẩm theo từng mảng danh mục
        foreach ($arr_id as $key_taxonomy => $val_taxonomy) {
            $params_post['status'] = App\Consts::TAXONOMY_STATUS['active'];
            $params_post['taxonomy'] = App\Consts::TAXONOMY['product'];
            $params_post['is_featured'] = true;
            $params_post['taxonomy_id'] = $val_taxonomy;
            $rows[$key_taxonomy] = App\Http\Services\ContentService::getCmsPost($params_post)
                ->limit(12)
                ->get();
        }
    @endphp
    <section class="section_tab_product section_product_tab_1">
        <div class="bg_module">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="not-dqtab e-tabs ajax-tab-1 ajax" data-section="ajax-tab-1" data-view="grid_1">
                            <div class="title_modules title_module_main clearfix">
                                <h2 class="title_tab">
                                    <span>{{ $title }}</span>
                                </h2>
                                <ul class="nav-tab">
                                    <li class="tab-link tabs-title tabtitle1 ajax current" data-id="0">
                                        <h4>Tất cả</h4>
                                    </li>
                                    @foreach ($taxonomys as $val)
                                        @if ($val->is_featured == 1)
                                            <li class="tab-link tabs-title tabtitle1 ajax"
                                                data-id="{{ $val->id }}">
                                                <h4>{{ $val->title }}</h4>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-container">
                                @foreach ($rows as $key => $items)
                                    <div
                                        class="tab-item tab-item-product tab-content tab-{{ $key }} {{ $loop->index == 0 ? 'current' : '' }}">
                                        <div class="contentfill">
                                            <div class="swiper_product swiper-container">
                                                <div class="swiper-wrapper">
                                                    @foreach ($items as $item)
                                                        @php
                                                            $title = $item->json_params->title->{$locale} ?? $item->title;
                                                            $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                                                            $price = $item->json_params->price ?? null;
                                                            $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                                                            // Viet ham xu ly lay slug
                                                            $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item->taxonomy_title, $item->taxonomy_id);
                                                            $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $item->id, 'detail', $item->taxonomy_title);
                                                        @endphp
                                                        <div class="swiper-slide">
                                                            <div
                                                                class="wishItem variants product-box product-block-item">
                                                                <div class="product-thumbnail">
                                                                    <a class="image_thumb scale_hover product-transition"
                                                                        href="{{ $alias }}"
                                                                        title="{{ $title }}">
                                                                        <img class="lazyload"
                                                                            src="{{ asset('images/load.gif') }}"
                                                                            data-src="{{ $image }}"
                                                                            alt="{{ $title }}" />
                                                                    </a>

                                                                    <span class="smart"><span>- 20% </span></span>
                                                                </div>
                                                                <div class="product-info">
                                                                    <div class="product-content">
                                                                        <h3 class="product-name">
                                                                            <a href="{{ $alias }}"
                                                                                title="$title">{{ $title }}</a>
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
                                                                        class="cart-button btn-buy firstb btn-cart button_35 left-to muangay btn-cart btn-views add_to_cart"
                                                                        title="Mua hàng">
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
                                                    @endforeach
                                                </div>
                                                <div class="swiper-button-prev">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M224 480c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25l192-192c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l169.4 169.4c12.5 12.5 12.5 32.75 0 45.25C240.4 476.9 232.2 480 224 480z" />
                                                    </svg>
                                                </div>
                                                <div class="swiper-button-next">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                        <path
                                                            d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z" />
                                                    </svg>
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
    </section>
@endif
