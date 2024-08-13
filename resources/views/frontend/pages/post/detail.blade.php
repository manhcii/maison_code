@extends('frontend.layouts.default')

@php
    $title = $detail->json_params->title->{$locale} ?? $detail->title;
    $brief = $detail->json_params->brief->{$locale} ?? null;
    $content = $detail->json_params->content->{$locale} ?? null;
    $image = $detail->image != '' ? $detail->image : null;
    $image_thumb = $detail->image_thumb != '' ? $detail->image_thumb : null;
    $date = date('H:i d/m/Y', strtotime($detail->created_at));
    
    // For taxonomy
    $taxonomy_json_params = json_decode($detail->taxonomy_json_params);
    $taxonomy_title = $taxonomy_json_params->title->{$locale} ?? $detail->taxonomy_title;
    $image_background = $taxonomy_json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? null);
    $taxonomy_alias = Str::slug($taxonomy_title);
    $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $taxonomy_alias, $detail->taxonomy_id);
    
    $seo_title = $detail->json_params->seo_title ?? $title;
    $seo_keyword = $detail->json_params->seo_keyword ?? null;
    $seo_description = $detail->json_params->seo_description ?? $brief;
    $seo_image = $image ?? ($image_thumb ?? null);
    
    // schema information
    $datePublished = date('d/m/Y', strtotime($detail->created_at));
    $dateModified = date('Y-m-d', strtotime($detail->updated_at));
@endphp

@push('style')
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
@endpush


@section('content')
    <div class="bodywrap">
        <div class="breadcrumb_background">
            <div class="title_full">
                <div class="container a-center">
                    <p class="title_page">{{$taxonomy_title}}</p>
                </div>
            </div>
            <section class="bread-crumb">
                <span class="crumb-border"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 a-left">
                            <ul class="breadcrumb">
                                <li class="home">
                                    <a href="/"><span>Trang chủ</span></a>
                                    <span class="mr_lr"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path
                                                d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z" />
                                        </svg></span>
                                </li>

                                <li>
                                    <a href="tin-tuc.html"><span>{{$taxonomy_title}}</span></a>
                                    <span class="mr_lr"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path
                                                d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z" />
                                        </svg></span>
                                </li>
                                <li>
                                    <strong><span>{{$title}}</span></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="blogpage">
            <div class="container layout-article"  >
                <div class="bg_blog">
                    <article class="article-main">
                        <div class="row">
                            <div class="right-content col-xl-8 col-lg-8 col-12">
                                <div class="article-details">
                                    <h1 class="article-title">
                                        {{$title}}
                                    </h1>

                                    <span class="time_post">
                                        <span class="name_"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M272 304h-96C78.8 304 0 382.8 0 480c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32C448 382.8 369.2 304 272 304zM48.99 464C56.89 400.9 110.8 352 176 352h96c65.16 0 119.1 48.95 127 112H48.99zM224 256c70.69 0 128-57.31 128-128c0-70.69-57.31-128-128-128S96 57.31 96 128C96 198.7 153.3 256 224 256zM224 48c44.11 0 80 35.89 80 80c0 44.11-35.89 80-80 80S144 172.1 144 128C144 83.89 179.9 48 224 48z" />
                                            </svg>&nbsp;Admin</span>
                                        &nbsp; | &nbsp;
                                        <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                <path
                                                    d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z" />
                                            </svg>&nbsp;Ngày {{$datePublished}}</span>
                                    </span>
                                    <div class="article-content">
                                        
                                        <div class="rte">
                                          {!! $content ?? '' !!}
                                        </div>
                                    </div>
                                </div>

                                <form method="post" class="d-none"
                                    action=""
                                    id="article_comments" accept-charset="UTF-8">
                                    <div class="form-coment d-none">
                                        <div class="margin-top-0 margin-bottom-30 w-100">
                                            <h5 class="title-form-coment">
                                                Viết bình luận của bạn:
                                            </h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <fieldset class="form-group padding-0">
                                                    <input placeholder="Họ và tên:" type="text"
                                                        class="form-control form-control-lg" value=""
                                                        id="full-name" name="Author" required />
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <fieldset class="form-group">
                                                    <input type="number" onkeypress="preventNonNumericalInput(event)"
                                                        placeholder="Số điện thoại:" name="contact[phone]" id="phone"
                                                        class="form-control form-control-lg" required />
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <fieldset class="form-group padding-0">
                                                    <input placeholder="Email:"
                                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" type="email"
                                                        class="form-control form-control-lg" value=""
                                                        name="Email" required />
                                                </fieldset>
                                            </div>
                                            <fieldset class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <textarea placeholder="Nội dung tin nhắn:" class="form-control form-control-lg" id="comment" name="Body"
                                                    rows="6" required></textarea>
                                            </fieldset>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary button_45">
                                                    Gửi bình luận
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End form mail -->
                                </form>
                            </div>
                            @include('frontend.components.sidebar.post')
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
    {{-- Print all content by [module - route - page] without blocks content at here --}}
    

    {{-- End content --}}
@endsection
