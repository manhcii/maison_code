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
    <section class="reason">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12 left-side">
                    <h2>{{ $title }}</h2>
                    {!! $content !!}
                    <a class="read-more d-flex align-items-center" href="{{ $url_link }}" title="Tìm hiểu">{{ $url_link_title }}
          <img class="m-l-15" src="{{ asset('themes/frontend/watches/images/right-icon.svg') }}" alt="slide">
        </a>
                </div>
                <div class="col-lg-7 col-md-12 col-12 right-side">
                    <div class="quanlity-item">
                        <div class="wrap-img">
                            <img class="img-fluid h-100" src="{{ asset('themes/frontend/watches/images/reason-img1.png') }}" alt="Văn hoá">
                        </div>
                        <div class="quanlity">Chất lượng</div>
                    </div>
                    <div class="presige-item">
                        <div class="presige">Uy tín</div>
                        <div class="wrap-img">
                            <img class="img-fluid h-100" src="{{ asset('themes/frontend/watches/images/reason-img2.png') }}" alt="Văn hoá">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif