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
  <div class="section mt-0 mb-0 p-0 bg-transparent" id="website_function">
    <div class="container">
      <div class="border-bottom-0 center">
        <p class="fw-bold">
          {!! nl2br($brief) !!}
        </p>
      </div>
      <div class="clear"></div>
      <div class="row mt-4 col-mb-50 mb-0">
        @if ($block_childs)
          @foreach ($block_childs as $item)
            @php
              $title_sub = $item->json_params->title->{$locale} ?? $item->title;
              $brief_sub = $item->json_params->brief->{$locale} ?? $item->brief;
              $image_sub = $item->image != '' ? $item->image : null;
              $icon_sub = $item->icon != '' ? $item->icon : null;
            @endphp
            <div class="col-sm-6 col-lg-4">
              <div class="feature-box values-container align-items-center">
                <div class="fbox-icon">
                  {!! $icon_sub !!}
                </div>
                <div class="fbox-content">
                  <h3 class="nott">{{ $title_sub }}</h3>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endif
