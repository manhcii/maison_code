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
    <section class="team">
        <div class="container">
            <h3>{{ $title }}</h3>
            <h2>{{ $brief }}</h2>
            <p>{{ $content }}
            </p>
            <div class="swiper Swiperteam">
                <div class="swiper-wrapper">
                    @if ($block_childs)
                    @foreach ($block_childs as $item)
                        @php
                            $title = $item->json_params->title->{$locale} ?? $item->title;
                            $image = $item->image != '' ? $item->image : null;
                        @endphp
                    <div class="swiper-slide">
                        <img src="{{ $image }}" alt="team">
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
@endif