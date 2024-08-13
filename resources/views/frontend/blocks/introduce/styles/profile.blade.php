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
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-12 left-side">
                    <h3>{{ $brief }}</h3>
                    <h2>{{ $title }}</h2>
                    <p>{{ $content }}
                    </p>
                    <div class="d-flex align-items-center">
                        <a class="download" href="{{ $url_link }}" title="Tìm hiểu">
                            {{ $url_link_title }}
                        </a>
                        <a href="{{ $url_link }}" class="wrap-btn">
                            <img class="img-fluid w-100"
                                src="{{ asset('themes/frontend/watches/images/icon/download.png') }}" alt="slide">
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-12 ">
                    <div class="swiper introduce">
                        <div class="swiper-wrapper">
                            @if ($block_childs)
                                @foreach ($block_childs as $item)
                                    @php
                                        $image = $item->image != '' ? $item->image : null;
                                    @endphp
                                    <div class="swiper-slide">
                                        <img src="{{ $image }}" alt="Wheels">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
