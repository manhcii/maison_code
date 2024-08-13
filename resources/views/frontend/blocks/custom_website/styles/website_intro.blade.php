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
  <div id="website_intro" class="section bg-transparent m-0">
    <div class="container">
      <div class="row align-items-end">
        <div class="col-lg-6">
          <div class="heading-block border-bottom-0 bottommargin-sm">
            <h1 class="nott ls0">{{ $title }}</h1>
          </div>
          <p>
            {!! nl2br($brief) !!}
          </p>

          @if ($url_link != '')
            <a href="{{ $url_link }}"
              class="button button-border button-rounded button-fill button-blue button-large ls0 text-uppercase">
              <span>{{ $url_link_title }}</span>
            </a>
          @endif

        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
          <img src="{{ $image }}" alt="Image" />
        </div>
      </div>
      <div class="clear line mb-0"></div>
    </div>
  </div>
@endif
