@extends('frontend.layouts.default')

@php
    $page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
    $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
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
                    <h1 class="title_page">{{ $page_title }}</h1>
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

                                <li>
                                    <strong><span>{{ $page_title }}</span></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="page_contact">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-sm-12 col-12">
                        <div class="single-contact a-center">
                            <div class="contact-icon">
                                <svg width="44" height="55" viewBox="0 0 44 55" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.0001 0.0769043C33.6644 0.0769043 43.154 9.56645 43.154 21.2307C43.154 26.897 39.7211 34.1734 32.9508 42.8571C29.849 46.8253 26.49 50.5854 22.8953 54.1133C22.6543 54.3438 22.3336 54.4725 22.0001 54.4725C21.6666 54.4725 21.346 54.3438 21.105 54.1133C17.5103 50.5854 14.1513 46.8253 11.0495 42.8571C4.27916 34.1734 0.846298 26.897 0.846298 21.2307C0.846298 9.56645 10.3358 0.0769043 22.0001 0.0769043ZM22.0001 36.3406C30.3322 36.3406 37.11 29.5628 37.11 21.2307C37.11 12.8987 30.3322 6.12086 22.0001 6.12086C13.6681 6.12086 6.89025 12.8987 6.89025 21.2307C6.89025 29.5628 13.6681 36.3406 22.0001 36.3406Z"
                                        fill="#339538" />
                                    <path
                                        d="M11.6309 19.4088L21.1286 10.7746C21.367 10.5579 21.6776 10.4378 21.9998 10.4378C22.3219 10.4378 22.6326 10.5579 22.8709 10.7746L32.3686 19.4088C32.5899 19.6101 32.7347 19.8816 32.7786 20.1775C32.8225 20.4733 32.7626 20.7752 32.6093 21.032C32.4883 21.2275 32.3187 21.3883 32.1171 21.4987C31.9154 21.6092 31.6886 21.6655 31.4588 21.6623H30.2023V29.8648C30.2023 30.2083 30.0658 30.5377 29.8229 30.7806C29.58 31.0235 29.2506 31.1599 28.9071 31.1599H25.8852C25.5417 31.1599 25.2122 31.0235 24.9694 30.7806C24.7265 30.5377 24.59 30.2083 24.59 29.8648V25.116C24.59 24.7725 24.4536 24.443 24.2107 24.2002C23.9678 23.9573 23.6384 23.8208 23.2949 23.8208H20.7046C20.3611 23.8208 20.0317 23.9573 19.7888 24.2002C19.5459 24.443 19.4095 24.7725 19.4095 25.116V29.8648C19.4095 30.2083 19.273 30.5377 19.0302 30.7806C18.7873 31.0235 18.4578 31.1599 18.1144 31.1599H15.0924C14.7489 31.1599 14.4195 31.0235 14.1766 30.7806C13.9337 30.5377 13.7972 30.2083 13.7972 29.8648V21.6623H12.5407C12.3109 21.6655 12.0841 21.6092 11.8824 21.4987C11.6808 21.3883 11.5112 21.2275 11.3902 21.032C11.2369 20.7752 11.1771 20.4733 11.2209 20.1775C11.2648 19.8816 11.4096 19.6101 11.6309 19.4088Z"
                                        fill="#339538" />
                                </svg>
                            </div>
                            <div class="title-contact">Địa chỉ</div>
                            <span>
                                {{ $web_information->information->address }}
                            </span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-12 col-12">
                        <div class="single-contact a-center">
                            <div class="contact-icon icon_2">
                                <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5318 24.4683C13.6774 20.6139 12.8071 16.7595 12.6107 15.2153C12.5558 14.7883 12.7028 14.3601 13.0083 14.0567L16.1274 10.9389C16.5863 10.4804 16.6677 9.76575 16.3238 9.21574L11.3575 1.50416C10.977 0.895119 10.1958 0.67531 9.55351 0.996597L1.58084 4.75143C1.06149 5.00717 0.75601 5.55897 0.814977 6.13487C1.23272 10.1034 2.96288 19.8592 12.5501 29.4471C22.1374 39.0351 31.8918 40.7646 35.8624 41.1823C36.4383 41.2413 36.9901 40.9358 37.2459 40.4164L41.0007 32.4438C41.3208 31.8029 41.1024 31.0238 40.4959 30.6426L32.7843 25.6777C32.2346 25.3334 31.52 25.4143 31.0611 25.8726L27.9434 28.9918C27.64 29.2973 27.2118 29.4442 26.7848 29.3894C25.2405 29.193 21.3862 28.3227 17.5318 24.4683Z"
                                        fill="#339538" />
                                    <path
                                        d="M30.7486 0.807693C24.9809 0.807693 20.305 4.85982 20.305 9.85884C20.3144 11.6931 20.9396 13.4709 22.0804 14.9073L21.0012 20.3025L26.4765 18.1121C27.8386 18.641 29.2874 18.9116 30.7486 18.91C36.5163 18.91 41.1922 14.8579 41.1922 9.85884C41.1922 4.85982 36.5163 0.807693 30.7486 0.807693ZM25.1787 11.2513C24.4096 11.2513 23.7862 10.6279 23.7862 9.85884C23.7862 9.0898 24.4096 8.46636 25.1787 8.46636C25.9477 8.46636 26.5711 9.0898 26.5711 9.85884C26.5711 10.6279 25.9477 11.2513 25.1787 11.2513ZM30.7486 11.2513C29.9796 11.2513 29.3561 10.6279 29.3561 9.85884C29.3561 9.0898 29.9796 8.46636 30.7486 8.46636C31.5177 8.46636 32.1411 9.0898 32.1411 9.85884C32.1411 10.6279 31.5177 11.2513 30.7486 11.2513ZM36.3185 11.2513C35.5495 11.2513 34.9261 10.6279 34.9261 9.85884C34.9261 9.0898 35.5495 8.46636 36.3185 8.46636C37.0876 8.46636 37.711 9.0898 37.711 9.85884C37.711 10.6279 37.0876 11.2513 36.3185 11.2513Z"
                                        fill="#339538" />
                                </svg>
                            </div>
                            <div class="title-contact">Tổng đài hỗ trợ</div>
                            <a href="mailto:hellocafein@gmail.com"
                                title="hellocafein@gmail.com">{{ $web_information->information->hotline }}</a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-12 col-12">
                        <div class="single-contact a-center">
                            <div class="contact-icon icon_3">
                                <svg width="45" height="38" viewBox="0 0 45 38" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38.4482 9.05962V16.9539L43.8375 12.8161L38.4482 9.05962Z" fill="#339538" />
                                    <path d="M6.873 9.05962L1.4837 12.8161L6.873 16.9539V9.05962Z" fill="#339538" />
                                    <path
                                        d="M36.8153 18.2064V0.730789H8.50579V18.2064L22.6605 29.0945L36.8153 18.2064ZM13.9503 6.17532H18.8499C19.3011 6.17532 19.6668 6.54107 19.6668 6.99226C19.6668 7.44345 19.3011 7.8092 18.8499 7.8092H13.9503C13.4991 7.8092 13.1334 7.44345 13.1334 6.99226C13.1334 6.54107 13.4991 6.17532 13.9503 6.17532ZM13.9503 11.0738H31.3707C31.8219 11.0738 32.1877 11.4396 32.1877 11.8908C32.1877 12.342 31.8219 12.7077 31.3707 12.7077H13.9503C13.4991 12.7077 13.1334 12.342 13.1334 11.8908C13.1334 11.4396 13.4991 11.0738 13.9503 11.0738ZM13.1334 16.7903C13.1334 16.3391 13.4991 15.9734 13.9503 15.9734H31.3707C31.8219 15.9734 32.1877 16.3391 32.1877 16.7903C32.1877 17.2415 31.8219 17.6073 31.3707 17.6073H13.9503C13.4991 17.6073 13.1334 17.2415 13.1334 16.7903Z"
                                        fill="#339538" />
                                    <path d="M0.884613 14.3405V37.2055L16.6722 26.5353L0.884613 14.3405Z" fill="#339538" />
                                    <path d="M28.649 26.5353L44.4366 37.2055V14.3405L28.649 26.5353Z" fill="#339538" />
                                    <path
                                        d="M23.1506 30.7273C22.8599 30.9451 22.4608 30.9451 22.1711 30.7273L18.0885 27.6242L2.95324 37.7505H42.3675L27.2874 27.57L23.1506 30.7273Z"
                                        fill="#339538" />
                                </svg>
                            </div>
                            <div class="title-contact">Email</div>
                            <a class="fone" href="tel:19006750"
                                title="19006750">{{ $web_information->information->email }}</a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="box-maps">
                            <div class="iFrameMap">
                                <div id="contact_map" class="map">
                                    @isset($web_information->source_code->map)
                                        {!! $web_information->source_code->map !!}
                                    @endisset
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="left_contact">
                                        <h1 class="title-head-contact a-center">
                                            Gửi thông tin liên hệ cho chúng tôi
                                        </h1>
                                        <p class="sum_title">
                                            Bạn hãy điền nội dung tin nhắn vào form dưới đây. Chúng
                                            tôi sẽ trả lời bạn ngay sau khi nhận được tin nhắn.
                                        </p>
                                        <div id="pagelogin">
                                            <form class="form_ajax" action="{{ route('frontend.contact.store') }}"
                                                method="post" id="contact" accept-charset="UTF-8">
                                                @csrf
                                                <input type="hidden" name="is_type" value="contact">


                                                <div class="form-signup clearfix">
                                                    <div class="row group_contact">
                                                        <fieldset
                                                            class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                            <input type="text" id="name" name="name"
                                                                value="" class="form-control  form-control-lg required" required
                                                                placeholder="Họ và tên:" />
                                                        </fieldset>
                                                        <fieldset
                                                            class="form-group col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                            <input type="text" id="phone" name="phone"
                                                                value="" class="form-control form-control-lg" required
                                                                placeholder="Số điện thoại:" />
                                                        </fieldset>
                                                        <fieldset
                                                            class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <input type="email" id="email" name="email" value=""
                                                class="form-control form-control-lg" required placeholder="Email:"/>
                                                        </fieldset>
                                                        <fieldset
                                                            class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <textarea class="form-control content-area form-control-lg" id="content" name="content" rows="6" cols="30" required></textarea>
                                                        </fieldset>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <button type="submit" class="btn btn-primary btn-lienhe">
                                                                Gửi liên hệ
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Print all content by [module - route - page] without blocks content at here --}}
    



    {{-- End content --}}
@endsection
