<link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Roboto:300,400,500,700|Rubik:400,600&amp;display=swap"
    rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('themes/frontend/maison/css/bootstrap.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('themes/frontend/maison/main.css') }}" />
<link rel="stylesheet" href="{{ asset('themes/frontend/maison/style.css') }}" />
<link rel="stylesheet" href="{{ asset('themes/frontend/maison/css/magnific-popup.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('themes/frontend/maison/collection_style.css') }}" type="text/css" />

{{-- <link rel="stylesheet" href="{{ asset('themes/frontend/maison/bizweb.css') }}" /> --}}

<style>
    .section_tab_product .tab-container {
        position: relative;
        width: 100%;
    }

    .section_tab_product .tab-container .tab-item-product {
        display: block;
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 0;
        width: 100%;
        opacity: 0;
    }

    .section_tab_product .tab-container .tab-item-product.current {
        display: block;
        position: relative;
        z-index: 1;
        opacity: 1;
    }

    @media (min-width: 992px) {
        .header .site-nav:before {
            content: "";
            background-image: url({{ asset('images/bg_menu1.png') }});
            position: absolute;
            width: 100%;
            height: 36px;
            top: 100%;
            left: 0;
            z-index: 9;
        }
    }

    .alert-fixed {
        padding-right: 2rem;
    }
</style>

@isset($web_information->source_code->header)
    {!! $web_information->source_code->header !!}
@endisset
