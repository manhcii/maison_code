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
  <style>
    .story-timeline>.story-timeline-line {
      background-image: linear-gradient(to bottom, #B3CAEC 0%, #0C4DA2 100%);
    }
    .story-timeline .story-timeline-dots {
      background-image: linear-gradient(to bottom, #4485e7 0%, #0C4DA2 100%);
    }
  </style>
  <div class="container">
    <div class="heading-block border-bottom-0 center mx-auto">
      <h3 class="nott ls0 mb-3">{{ $title }}</h3>
      <p>{!! nl2br($brief) !!}</p>
    </div>

    <div class="text-md-center">
      <h3 class="bg-color d-inline-block px-4 py-2 text-white mb-0 rounded-1">
        {{ $content }}
      </h3>
    </div>
    <div class="story-timeline">
      <div class="clear mt-4"></div>
      <div class="story-timeline-line"></div>

      @if ($block_childs)
        @foreach ($block_childs as $item)
          @php
            $title_sub = $item->json_params->title->{$locale} ?? $item->title;
            $brief_sub = $item->json_params->brief->{$locale} ?? $item->brief;
            $content_sub = $item->json_params->content->{$locale} ?? $item->content;
            $image_sub = $item->image != '' ? $item->image : null;
            $icon_sub = $item->icon != '' ? $item->icon : null;
          @endphp
          <div class="row justify-content-md-center">
            <div class="col-md-6 {{ $loop->index % 2 == 0 ? 'text-md-end' : 'order-md-2' }}">
              <h4 class="bg-primary d-inline-block px-3 py-1 text-white mb-0 rounded-1 mb-3">
                {{ $title_sub }}
              </h4>
            </div>
            <div class="story-timeline-dots"></div>
            <div class="col-md-6">
              <h3 class="mb-3">{{ $brief_sub }}</h3>
              {{ $content_sub }}
            </div>
          </div>
          <div class="clear my-5"></div>
        @endforeach
      @endif
    </div>
  </div>
@endif
