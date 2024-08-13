<div class="sidebar col-lg-12">
    <div class="sidebar-widgets-wrap">
        @php
            $params_product['status'] = App\Consts::POST_STATUS['active'];
            $params_product['is_type'] = App\Consts::POST_TYPE['product'];
            $params_product['order_by'] = 'id';

            $recents = App\Http\Services\ContentService::getCmsPost($params_product)
                ->limit(App\Consts::PAGINATE['sidebar'])
                ->get();
        @endphp
        @isset($recents)
            <div class="widget clearfix">

                <h2>@lang('Latest products')</h2>

                <div class="real-estate mt-2 grid-container row portfolio gutter-20 col-mb-50" data-layout="fitRows">
                    @foreach ($recents as $item)
                        @php

                            $title = $item->json_params->title->{$locale} ?? $item->title;
                            $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                            $price = $item->price ?? '0';
                            $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                            $convenient = $item->json_product??[];
                            $city_name = '';
                            if (isset($item->city) && $item->city > 0) {
                                $city_name = '';
                                foreach ($City as $val) {
                                    if ($val['id'] == $item->city) {
                                        $city_name = $val['name'];
                                        break;
                                    }
                                }
                            }
                            $i = 0;
                            // Viet ham xu ly lay slug
                            $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                            $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                        @endphp
                        <div class="real-estate-item portfolio-item col-12 col-md-6 col-lg-4">
                            <div class="real-estate-item-image">
                                <div class="label badge bg-danger">Ưu đãi</div>
                                <a href="{{ $alias }}">
                                    <img style="height: 200px;object-fit: cover;width: 100%;" src="{{ $image }}" alt="{{ $title }}">
                                </a>
                                <div class="real-estate-item-price">đ</span>
                                </div>
                                <div class="real-estate-item-info clearfix" data-lightbox="gallery">
                                    <a href="{{ $image }}" data-bs-toggle="tooltip" title="Hình ảnh"
                                        data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                                    @isset($item->json_params->gallery_image)
                                        @foreach ($item->json_params->gallery_image as $key => $value)
                                            <a href="{{ $value }}" class="d-none"
                                                data-lightbox="gallery-item"></a>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>

                            <div class="real-estate-item-desc p-0">
                                <h3><a href="{{ $alias }}">{{ $title }}</a></h3>
                                <span>Khu vực {{ $city_name }}</span>


                                <div class="line" style="margin-top: 15px; margin-bottom: 15px;"></div>

                                <div class="real-estate-item-features fw-medium font-primary clearfix">
                                    <div class="row g-0">
                                        <div class="col-lg-6 p-0">Diện tích: <span
                                            class="color">{{ $item->spft }}m2</span></div>
                                        <div class="col-lg-6 p-0">Phòng ngủ: <span
                                                class="color">{{ $item->bedrooom }}</span></div>

                                        @if (isset($item->json_product->convenient))
                                            @foreach ($convenient['convenient']['name'] as $val)
                                                @php
                                                    if ($i == 2) {
                                                        break;
                                                    }
                                                    if ($val == '') {
                                                        continue;
                                                    }
                                                    $i++;
                                                @endphp
                                                <div class="col-lg-6 p-0">{{ $val }}:
                                                    <span class="text-success"><i
                                                            class="icon-check-sign"></i></span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        @endisset

        @php
            $params_product['status'] = App\Consts::POST_STATUS['active'];
            $params_product['is_type'] = App\Consts::POST_TYPE['product'];
            $params_product['order_by'] = 'count_visited';

            $mostViews = App\Http\Services\ContentService::getCmsPost($params_product)
                ->limit(App\Consts::PAGINATE['sidebar'])
                ->get();
        @endphp
        @isset($mostViews)
            <div class="widget clearfix">

                <h2>@lang('Most viewed products')</h2>

                <div class="real-estate mt-2 grid-container row portfolio gutter-20 col-mb-50" data-layout="fitRows">
                    @foreach ($mostViews as $item)
                        @php

                            $title = $item->json_params->title->{$locale} ?? $item->title;
                            $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                            $price = $item->price ?? '0';
                            $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                            $convenient = $item->json_product??[];
                            $city_name = '';
                            if (isset($item->city) && $item->city > 0) {
                                $city_name = '';
                                foreach ($City as $val) {
                                    if ($val['id'] == $item->city) {
                                        $city_name = $val['name'];
                                        break;
                                    }
                                }
                            }
                            $i = 0;
                            // Viet ham xu ly lay slug
                            $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                            $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                        @endphp
                        <div class="real-estate-item portfolio-item col-12 col-md-6 col-lg-4">
                            <div class="real-estate-item-image">
                                <div class="label badge bg-danger">Ưu đãi</div>
                                <a href="{{ $alias }}">
                                    <img style="height: 200px;object-fit: cover;width: 100%;" src="{{ $image }}" alt="{{ $title }}">
                                </a>
                                <div class="real-estate-item-price">
                                    </span>
                                </div>
                                <div class="real-estate-item-info clearfix" data-lightbox="gallery">
                                    <a href="{{ $image }}" data-bs-toggle="tooltip" title="Hình ảnh"
                                        data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                                    @isset($item->json_params->gallery_image)
                                        @foreach ($item->json_params->gallery_image as $key => $value)
                                            <a href="{{ $value }}" class="d-none"
                                                data-lightbox="gallery-item"></a>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>

                            <div class="real-estate-item-desc p-0">
                                <h3><a href="{{ $alias }}">{{ $title }}</a></h3>
                                <span>Khu vực {{ $city_name }}</span>


                                <div class="line" style="margin-top: 15px; margin-bottom: 15px;"></div>

                                <div class="real-estate-item-features fw-medium font-primary clearfix">
                                    <div class="row g-0">
                                        <div class="col-lg-6 p-0">Diện tích: <span
                                            class="color">{{ $item->spft }}m2</span></div>
                                        <div class="col-lg-6 p-0">Phòng ngủ: <span
                                                class="color">{{ $item->bedrooom }}</span></div>

                                        @if (isset($item->json_product->convenient))
                                            @foreach ($convenient['convenient']['name'] as $val)
                                                @php
                                                    if ($i == 2) {
                                                        break;
                                                    }
                                                    if ($val == '') {
                                                        continue;
                                                    }
                                                    $i++;
                                                @endphp
                                                <div class="col-lg-6 p-0">{{ $val }}:
                                                    <span class="text-success"><i
                                                            class="icon-check-sign"></i></span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

        @endisset

    </div>
</div>
