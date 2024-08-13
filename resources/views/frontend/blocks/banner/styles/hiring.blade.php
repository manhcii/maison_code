@if ($block)
  @php
    $title = $block->json_params->title->{$locale} ?? $block->title;
    $brief = $block->json_params->brief->{$locale} ?? $block->brief;
    $image = $block->image != '' ? $block->image : '';
    $content = $block->json_params->content->{$locale} ?? $block->content;
    $image_background = $block->image_background != '' ? $block->image_background : '';
    $url_link = $block->url_link != '' ? $block->url_link : '';
    $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
    $style = isset($block->json_params->style) && $block->json_params->style == 'slider-caption-right' ? 'd-none' : '';
    // Filter all blocks by parent_id
    $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        return $item->parent_id == $block->id;
    });
  @endphp
  <section class="hiring">
    <div class="container">
        <div class="hiring-box">
            <div class="hiring-container">
                <img src="{{ $image }}" alt="">
            </div>
        </div>
        <div class="submit-hiring">
            <a href="{{ $url_link }}"><button type="button" class="btn ">{{ $url_link_title }}</button></a>
        </div>
    </div>

</section>
@endif