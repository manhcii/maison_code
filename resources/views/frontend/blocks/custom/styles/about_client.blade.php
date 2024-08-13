@if ($block)
    @php
        
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $content = $block->json_params->content->{$locale} ?? $block->content;
        $image = $block->image != '' ? $block->image : '';
        $image_background = $block->image_background != '' ? $block->image_background : '';
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
        $image_for_screen = null;
        if ($agent->isDesktop() && $image_background != null) {
            $image_for_screen = $image_background;
        } else {
            $image_for_screen = $image;
        }
        // Filter all blocks by parent_id
        $block_childs = $blocks->filter(function ($item, $key) use ($block) {
            return $item->parent_id == $block->id;
        });
        
    @endphp
    <section class="section_intro">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 col-intro-1">
                    <div class="banner_intro">
                        <a href="{{ $url_link }}" title="{{ $url_link_title }}">
                            <img class="lazyload" src="{{ asset('images/load.gif') }}" data-src="{{ $image_for_screen }}"
                                alt="{{ $url_link_title }}" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-12 col-intro-2">
                    <div class="title_module_main no-bg clearfix">
                        <h3>
                            <span>{{ $title }}</span>
                        </h3>
                        <h2>
                            <span>{{ $brief }}</span>
                        </h2>
                    </div>
                    <div class="contentpage clearfix">
                        {!! $content !!}
                    </div>
                    <div class="img_intro_list">
                        <div class="intro_img_swiper swiper-container">
                            <div class="swiper-wrapper">
                                @if ($block_childs)
                                    @foreach ($block_childs as $item)
                                        @php
                                            $title_childs = $item->json_params->title->{$locale} ?? $item->title;
                                            $brief_childs = $item->json_params->brief->{$locale} ?? $item->brief;
                                            $content_childs = $item->json_params->content->{$locale} ?? $item->content;
                                            $image = $item->image != '' ? $item->image : null;
                                            $image_background = $item->image_background != '' ? $item->image_background : null;
                                            $url_link = $item->url_link != '' ? $item->url_link : '';
                                            $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                                            $image_for_screen = null;
                                            if ($agent->isDesktop() && $image_background != null) {
                                                $image_for_screen = $image_background;
                                            } else {
                                                $image_for_screen = $image;
                                            }
                                        @endphp
                                        <div class="swiper-slide">
                                            <a href="{{ $url_link }}" title="{{ $url_link_title }}">
                                                <img class="img-responsive lazyload" width="186" height="173"
                                                    src="{{ asset('images/load.gif') }}"
                                                    data-src="{{ $image_for_screen }}" alt="{{ $url_link_title }}" />
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
