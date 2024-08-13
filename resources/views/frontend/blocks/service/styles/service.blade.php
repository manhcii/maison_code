@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $content = $block->json_params->content->{$locale} ?? $block->content;
        $image = $block->image != '' ? $block->image : '';
        $image_background = $block->image_background != '' ? $block->image_background : '';
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;


        $params['is_featured'] = true;
        $params['status'] = App\Consts::POST_STATUS['active'];
        $params['is_type'] = App\Consts::POST_TYPE['product'];
        $rows = App\Http\Services\ContentService::getCmsPost($params)
        ->limit(6)
        ->get();
    @endphp
    <section class="service">
        <div class="container">
            <div class="swiper swiper-service">
                <div class="swiper-wrapper align-items-center">
                    @if ($rows)
                    @foreach ($rows as $item)
                        @php
                            $title = $item->json_params->title->{$locale} ?? $item->title;
                            $brief = $item->json_params->brief->{$locale} ?? $item->brief??"";
                            $content = $item->json_params->content->{$locale} ?? $item->content??"";
                            $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                            $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                            $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                        @endphp
                    <div class="swiper-slide">
                        <div class="slide-item">
                            <div class="slide-img">
                                <img src="{{ $image }}" alt="service">
                            </div>
                            <div class="slide-info">
                                <h3>{{ $title }}</h3>
                                {!! $brief !!}
                                
                                <a href="{{ $alias }}"><button>Tìm hiểu thêm</button></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
@endif
