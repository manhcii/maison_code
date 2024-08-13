@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $content = $block->json_params->content->{$locale} ?? $block->content;
    $image = $block->image != '' ? $block->image : null;
    $image_background = $block->image_background != '' ? $block->image_background : null;
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $style = isset($block->json_params->style) && $block->json_params->style == 'slider-caption-right' ? 'd-none' : '';
    
    // Filter all blocks by parent_id
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
  @endphp
  <style>
    .flex-d-reverse {
      flex-direction: row-reverse;
    }
  </style>
  <div class="section bg-transparent my-0">

    @if ($block_childs)
      @foreach ($block_childs as $item)
        @php
          $title_sub = $item->json_params->title->{$locale} ?? $item->title;
          $brief_sub = $item->json_params->brief->{$locale} ?? $item->brief;
          $image_sub = $item->image != '' ? $item->image : null;
          $icon_sub = $item->icon != '' ? $item->icon : null;
          
          $url_link_sub = $item->url_link != '' ? $item->url_link : '';
          $url_link_title_sub = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
          
        @endphp
        <div class="container">
          <div class="row align-items-end {{ $loop->index % 2 == 1 ? 'flex-d-reverse' : '' }}">
            <div class="col-lg-6">
              <div class="heading-block border-bottom-0 bottommargin-sm">
                <h2 class="nott ls0">
                  {{ $title_sub }}
                </h2>
              </div>
              <p>
                {!! nl2br($brief_sub) !!}
              </p>

            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
              <img src="{{ $image_sub }}" alt="Image" />
            </div>
          </div>
          @if (!$loop->last)
            <div class="clear line my-6"></div>
          @endif


          <div class="clear"></div>
        </div>
      @endforeach
    @endif

  </div>
@endif
