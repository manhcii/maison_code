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

    <div id="service" class="section page-section bg-transparent p-0 mt-0 clearfix">

        <div class="row align-items-stretch clearfix bottommargin">

            <!-- Service Image
        ============================================= -->
            <div class="col-lg-6 center col-padding parallax" style="background-image: url('{{ $image }}');"
                data-bottom-top="background-position:0px 100px;" data-top-bottom="background-position:0px -300px;">
                <div class="vertical-middle dark d-none">
                    <div class="heading-block border-0 center">
                        <h2 class="nott ls0" style="font-size: 54px">{{ $title }}</h2>
                    </div>
                </div>
            </div>

            <!-- Service Featured Boxes
        ============================================= -->
            <div class="col-lg-6 col-padding" style="background-color: #F9F9F9">
                <div>
                    <div class="row clearfix" style="padding: 20px 0">
                        @if ($block_childs)
                            @foreach ($block_childs as $item)
                                @php
                                    $title_child = $item->json_params->title->{$locale} ?? $item->title;
                                    $brief_child = $item->json_params->brief->{$locale} ?? $item->brief;
                                    $content_child = $item->json_params->content->{$locale} ?? $item->content;
                                    $image_child = $item->image != '' ? $item->image : null;
                                    $url_link = $item->url_link != '' ? $item->url_link : 'javascript:void(0)';
                                    $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                                    $icon = $item->icon != '' ? $item->icon : '';
                                    $style = $item->json_params->style ?? '';
                                @endphp
                                <div class="col-lg-10 col-md-8 bottommargin">
                                    <div class="feature-box fbox-plain">
                                        <div class="fbox-icon">
                                            <img src="{{$image_child}}"
                                                    alt="{{$title_child}}">
                                        </div>
                                        <div class="fbox-content">
                                            <h3>{{$title_child}}</h3>
                                            <p>{{$brief_child}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
            </div>

        </div>
    </div>
@endif
