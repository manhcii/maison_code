@if ($block)
    @php
        
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $content = $block->json_params->content->{$locale} ?? $block->content;
        $image = $block->image != '' ? $block->image : '';
        $image_background = $block->image_background != '' ? $block->image_background : ($web_information->image->background_breadcrumbs ?? '');
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
        $image_for_screen = null;
        if ($agent->isDesktop() && $image_background != null) {
            $image_for_screen = $image_background;
        } else {
            $image_for_screen = $image;
        }
        // Filter all blocks by parent_id
        $block_childs = $blocks->filter(function ($item, $key) use ($block) {
            return $item->parent_id == $block->id;
        });
        
    @endphp


    <style>
        .breadcrumb_background {
            background-image: url({{ $image_background }});
            position: relative;
            justify-content: center;
            text-align: center;
            align-items: center;
            min-height: 202px;
            flex-flow: column;
            display: flex;
            position: relative;
            padding-top: 30px
        }
    </style>
    <div class="bodywrap">
        <div class="breadcrumb_background">
            <div class="title_full">
                <div class="container a-center">
                    <h1 class="title_page">{{ $title }}</h1>
                </div>
            </div>
            <section class="bread-crumb">
                <span class="crumb-border"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 a-left">
                            <ul class="breadcrumb">
                                <li class="home">
                                    <a href="index.html"><span>Trang chủ</span></a>
                                    <span class="mr_lr"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path
                                                d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z" />
                                        </svg></span>
                                </li>
                                <li><strong><span>{{ $title }}</span></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="page">
            <div class="container">
                <div class="pg_page padding-top-15">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title category-title">
                                <h1 class="title-head hidden">{{ $title }}</h1>
                            </div>
                            <div class="content-page rte">
                                {!! $content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endif
