@extends('frontend.layouts.default')

@php
    $page_title = $taxonomy->title ?? ($page->title ?? $page->name);
    $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');

    $title = $taxonomy->json_params->title->{$locale} ?? ($taxonomy->title ?? null);
    $image = $taxonomy->json_params->image ?? null;
    $seo_title = $taxonomy->json_params->seo_title ?? $title;
    $seo_keyword = $taxonomy->json_params->seo_keyword ?? null;
    $seo_description = $taxonomy->json_params->seo_description ?? null;
    $seo_image = $image ?? null;

@endphp

@section('content')
    <section id="page-title" class="page-title-parallax page-title-dark page-title-center include-header include-topbar"
        style="background: url('{{$image_background}}') no-repeat center center / cover; padding: 130px 0;"
        data-center="background-position: 0px -130px;" data-top-bottom="background-position:0px 200px;">

        <div class="container clearfix">
            <h1>{{ $page_title }}</h1>

        </div>

        <div class="video-wrap" style="position: absolute; top: 0; left: 0; height: 100%; z-index:1;">
            <div class="video-overlay" style="background: rgba(0,0,0,0.2);"></div>
        </div>

    </section>

    <section id="content">
        <div class="content-wrap">
            <div class="container mb-3">
                <div class="row mb-5 clearfix">
                    <div class="postcontent col-lg-9">
                        <div class="row col-mb-50 mb-0">
                            @foreach ($posts as $item)
                                @php
                                    $title = $item->json_params->title->{$locale} ?? $item->title;
                                    $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                                    $icon = $item->json_params->icon ?? $item->icon;
                                    $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                                    // $date = date('H:i d/m/Y', strtotime($item->created_at));
                                    $date = date('d', strtotime($item->created_at));
                                    $month = date('M', strtotime($item->created_at));
                                    $year = date('Y', strtotime($item->created_at));
                                    // Viet ham xu ly lay slug
                                    $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                                    $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                                @endphp
                                <div class="col-sm-6 col-lg-4">
                                    <div class="feature-box fbox-plain">
                                        <div class="fbox-icon">
                                            <a href="{{ $alias }}"><i class="{{ $icon }}"></i></a>
                                        </div>
                                        <div class="fbox-content">
                                            <h3 class="fw-normal">{{ $title }}</h3>
                                            <p>{{ $brief }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $posts->withQueryString()->links('frontend.pagination.default') }}
                        </div>
                    </div>

                    @include('frontend.components.sidebar.post')

                </div>
            </div>
        </div>
    </section>
    {{-- End content --}}
@endsection
