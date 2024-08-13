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
    @endphp<section class="popular">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 pd-r-2">
                    <div class="we_are">
                        <img src="{{ $image }}" alt="we">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="text-des">{{ $brief }}</h3>
                    <h2 class="text-title">{{ $title }}</h2>
                    <p class="text-content">{!! $content !!}</p>
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-4">
                        <div class="vitamin">
                            <div class="">
                                <p class="vitamin_1">GBD</p>
                                <p class="vitamin_2">ONESI</p>
                                <p class="vitamin_3">CEO<br> Global Brand Design</p>
                            </div>
                            <img class="img_vitamin" src="{{ asset('themes/frontend/watches/images/we_are_2.png') }}"
                                alt="vitamin">
                        </div>
                        <div class="m_include">
                            @if ($block_childs)
                                @foreach ($block_childs as $item)
                                    @php
                                        $title = $item->json_params->title->{$locale} ?? $item->title;
                                    @endphp
                                    <p><i class="fa fa-check"></i> {{ $title }}</p>
                                @endforeach
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endif
