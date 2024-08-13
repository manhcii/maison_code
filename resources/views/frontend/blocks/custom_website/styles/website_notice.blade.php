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
  <div class="section my-0"
    style="
  padding: 100px 0;
  overflow: visible;
  background: url('{{ $image_background }}') no-repeat top
    center;
  background-size: cover;
">
    <div class="container">
      <div class="heading-block border-bottom-0 center">
        <h2 class="nott ls0">
          {!! nl2br($brief) !!}
        </h2>
        @if ($url_link != '')
          <a href="{{ $url_link }}"
            class="button button-border button-rounded button-fill button-blue button-large ls0 mt-4">
            <span>{{ $url_link_title }}</span>
          </a>
        @endif
      </div>
    </div>
  </div>
@endif
