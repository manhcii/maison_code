@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $content = $block->json_params->content->{$locale} ?? $block->content;
        $image = $block->image != '' ? $block->image : '';
        $image_background = $block->image_background != '' ? $block->image_background : '';
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;

        $block_childs = $blocks->filter(function ($item, $key) use ($block) {
            return $item->parent_id == $block->id;
        });
    @endphp
    <!-- START SLIDER-->
    <section class="slider">
        <div class="swiper slider-content ">
            <div class="swiper-wrapper">
                @if ($block_childs)
                    @foreach ($block_childs as $item)
                        @php
                            $title = $item->json_params->title->{$locale} ?? $item->title;
                            $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                            $content = $item->json_params->content->{$locale} ?? $item->content;
                            $image = $item->image != '' ? $item->image : null;
                            $image_background = $item->image_background != '' ? $item->image_background : null;
                            $video = $item->json_params->video ?? null;
                            $video_background = $item->json_params->video_background ?? null;
                            $url_link = $item->url_link != '' ? $item->url_link : '';
                            $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                            $icon = $item->icon != '' ? $item->icon : '';
                        @endphp
                        <div class="swiper-slide slider-item">
                            <img src="{{ $image }}" alt="Customize. Modify. Upgrade. Repair. Replace"
                                title="Customize. Modify. Upgrade. Repair. Replace" />
                            <div class="slider-item-container">
                                <div class="container d-flex align-items-center justify-content-end">
                                    <div class="slider-item-content text-end">
                                        <h2>{{ $title }}</h2>
                                        <h3>{{ $brief }}</h3>
                                        <p>
                                            {{ $content }}
                                        </p>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a class="d-flex align-items-center" href="{{ $url_link }}"
                                                title="Tìm hiểu">{{ $url_link_title }}
                                                <img style="width: 25px" class="m-l-15"
                                                    src="{{ asset('themes/frontend/watches/images/right-icon.svg') }}"
                                                    alt="slide"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- END SLIDER-->
@endif
