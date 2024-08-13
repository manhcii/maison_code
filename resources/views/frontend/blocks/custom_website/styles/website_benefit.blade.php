@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $content = $block->json_params->content->{$locale} ?? $block->content;
    $image = $block->image != '' ? $block->image : '';
    $image_background = $block->image_background != '' ? $block->image_background : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $style = isset($block->json_params->style) && $block->json_params->style == 'slider-caption-right' ? 'd-none' : '';
    
    // Filter all blocks by parent_id
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
  @endphp
  <div class="section mb-0">
    <div class="container">
      <div class="heading-block border-bottom-0 center">
        <h3 class="nott ls0">
          {{ $title }}
        </h3>
      </div>
      <div class="row col-mb-30 align-content-stretch">
        @if ($block_childs)
          @foreach ($block_childs as $item)
            @php
              $title_sub = $item->json_params->title->{$locale} ?? $item->title;
              $brief_sub = $item->json_params->brief->{$locale} ?? $item->brief;
              $image_sub = $item->image != '' ? $item->image : null;
              $icon_sub = $item->icon != '' ? $item->icon : null;
            @endphp
            <div class="col-lg-4 col-md-6 d-flex">
              <div class="card">
                <div class="card-body p-5">
                  <div class="feature-box flex-column">
                    <div class="fbox-icon mb-3">
                      <img src="{{ $image_sub }}" alt="{{ $title_sub }}" class="bg-transparent rounded-0" />
                    </div>
                    <div class="fbox-content">
                      <h3 class="nott ls0 text-larger">
                        {{ $title_sub }}
                      </h3>
                      <p class="text-smaller">
                        {!! nl2br($brief_sub) !!}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endif
