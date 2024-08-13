<script src="{{ asset('themes/frontend/maison/js/jquery.js') }}"></script>
<script src="{{ asset('themes/frontend/maison/js/plugins.min.js') }}"></script>
<script src="{{ asset('themes/frontend/maison/js/main.js') }}"></script>
<script src="{{ asset('themes/frontend/maison/js/swiper.js') }}"></script>
<script src="{{ asset('themes/frontend/maison/js/lazysizes.min.js') }}"></script>
<script src="{{ asset('themes/frontend/maison/js/functions.js') }}"></script>


<script>
   
    $(function() {

        $("#form-booking").submit(function(e) {
            //  $(".form-process").show();
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(response) {
                    form[0].reset();
                    //  $(".form-process").hide();
                    alert(response.message);
                    location.reload();
                },
                error: function(response) {
                    //  $(".form-process").hide();
                    // Get errors
                    if (typeof response.responseJSON.errors !== 'undefined') {
                        var errors = response.responseJSON.errors;
                        // Foreach and show errors to html
                        var elementErrors = '';
                        $.each(errors, function(index, item) {
                            if (item === 'CSRF token mismatch.') {
                                item = "@lang('CSRF token mismatch.')";
                            }
                            elementErrors += '<p>' + item + '</p>';
                        });
                        $(".form-result").html(elementErrors);
                    } else {
                        var errors = response.responseJSON.message;
                        if (errors === 'CSRF token mismatch.') {
                            $(".form-result").html("@lang('CSRF token mismatch.')");
                        } else if (errors === 'The given data was invalid.') {
                            $(".form-result").html("@lang('The given data was invalid.')");
                        } else {
                            $(".form-result").html(errors);
                        }
                    }
                }
            });
        });

        // Form ajax default
        $(".form_ajax").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(response) {
                    form[0].reset();
                    alert(response.message);
                    location.reload();
                },
                error: function(response) {
                    // Get errors
                    console.log(response);
                    var errors = response.responseJSON.errors;
                    // Foreach and show errors to html
                    var elementErrors = '';
                    $.each(errors, function(index, item) {
                        if (item === 'CSRF token mismatch.') {
                            item = "@lang('CSRF token mismatch.')";
                        }
                        elementErrors += '<p>' + item + '</p>';
                    });
                }
            });
        });

        // Add to cart
        $(document).on('click', '.add-to-cart', function() {
            let _root = $(this);
            let _html = _root.html();
            let _id = _root.attr("data-id");
            let _quantity = _root.attr("data-quantity") ?? $("#quantity").val();
            if (_id > 0) {
                _root.html("@lang('Processing...')");
                var url = "{{ route('frontend.order.add_to_cart') }}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": _id,
                        "quantity": _quantity
                    },
                    success: function(data) {
                        _root.html(_html);
                        window.location.reload();
                    },
                    error: function(data) {
                        // Get errors
                        var errors = data.responseJSON.message;
                        alert(errors);
                        location.reload();
                    }
                });
            }
        });
        $(document).on('click', '.add_to_cart', function() {
            let _root = $(this);
            let _id = _root.attr("data-id");
            let _quantity =$(".prd_quantity").val();
            add_to_cart(_id, _quantity);
        });

        function add_to_cart(_id, _quantity){
            if (_id > 0 && _quantity > 0) {
                var url = "{{ route('frontend.order.add_to_cart') }}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": _id,
                        "quantity": _quantity
                    },
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(data) {
                        // Get errors
                        var errors = data.responseJSON.message;
                        alert(errors);
                        location.reload();
                    }
                });
            }
        }
        
        $(".update-cart").change(function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ route('frontend.order.cart.update') }}',
                method: "PATCH",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents(".quantity").attr("data-id"),
                    quantity: ele.parents("tr").find(".qty").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("{{ __('Are you sure want to remove?') }}")) {
                $.ajax({
                    url: '{{ route('frontend.order.cart.remove') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
        
        $(".btn-buy-now").click(function(e) {
            var _id = $(this).attr('data-id');
            var _quantity = $(".prd_quantity").val();
            if (_id > 0 && _quantity > 0) {
                var url = "{{ route('frontend.order.add_to_cart') }}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": _id,
                        "quantity": _quantity
                    },
                    success: function(data) {
                        window.location.href = '{{ route('frontend.order.cart') }}';
                    },
                    error: function(data) {
                        // Get errors
                        var errors = data.responseJSON.message;
                        alert(errors);
                        location.reload();
                    }
                });
            }
        });



    });

    const filterArray = (array, fields, value) => {
        fields = Array.isArray(fields) ? fields : [fields];
        return array.filter((item) => fields.some((field) => item[field] === value));
    };
    var swiper = new Swiper(".home-slider", {
        autoplay: false,
        pagination: {
            el: ".home-slider .swiper-pagination",
            clickable: true,
        },
    });

    var swiperwish = new Swiper(".blog-swiper", {
        slidesPerView: 3,
        loop: false,
        grabCursor: true,
        spaceBetween: 30,
        roundLengths: true,
        slideToClickedSlide: false,
        autoplay: false,
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            500: {
                slidesPerView: 1.3,
                spaceBetween: 30,
            },
            640: {
                slidesPerView: 1.3,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
    var swiperwish = new Swiper(".intro_img_swiper", {
        slidesPerView: 3,
        loop: false,
        grabCursor: true,
        spaceBetween: 20,
        roundLengths: true,
        slideToClickedSlide: false,
        autoplay: false,
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
        },
    });

    var swiperwish = new Swiper(".swiper_service", {
        slidesPerView: 3,
        loop: false,
        grabCursor: true,
        spaceBetween: 30,
        roundLengths: true,
        slideToClickedSlide: false,
        autoplay: false,
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            500: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
    var swiperwish = new Swiper(".swiper_product", {

        slidesPerView: 4,
        slidesPerColumn: 2,
        loop: false,
        grabCursor: true,
        spaceBetween: 30,
        roundLengths: true,
        slideToClickedSlide: false,
        autoplay: false,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            300: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            500: {
                slidesPerView: 1.3,
                spaceBetween: 30,
            },
            640: {
                slidesPerView: 1.3,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });
    var swiper = new Swiper(".product-relate-swiper", {
        slidesPerView: 4,
        loop: false,
        grabCursor: true,
        spaceBetween: 30,
        roundLengths: true,
        slideToClickedSlide: false,
        navigation: {
            nextEl: ".swiper_relate .swiper-button-next",
            prevEl: ".swiper_relate .swiper-button-prev",
        },
        autoplay: false,
        breakpoints: {
            300: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            500: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            991: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        },
    });
    var galleryThumbs = new Swiper(".gallery-thumbs", {
        spaceBetween: 4,
        slidesPerView: 0,
        direction: "vertical",
        freeMode: true,
        lazy: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        hashNavigation: true,
        slideToClickedSlide: true,
        breakpoints: {
            300: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            500: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1199: {
                slidesPerView: 4,
                spaceBetween: 0,
            },
        },
        navigation: {
            nextEl: ".swiper_thumbs .swiper-button-next",
            prevEl: ".swiper_thumbs .swiper-button-prev",
        },
    });
    var galleryTop = new Swiper(".gallery-top", {
        spaceBetween: 0,
        lazy: true,
        hashNavigation: true,
        thumbs: {
            swiper: galleryThumbs,
        },
    });

    $('.tab-link').click(function() {
        $('.tab-link').removeClass('current');
        $('.tab-item').removeClass('current');
        $(this).addClass('current');
        var id = $(this).attr('data-id');
        $('.tab-' + id).addClass('current');
    })
    $('.close.btn-close').click(function() {
        $('.alert-dismissible').remove();
    })

    $(".tab-content .rte").each(function(e) {
        if ($(".tab-content .rte #content").height() >= 300) {
            $(".tab-content")
                .find(".read-more")
                .removeClass("d-none")
                .addClass("more");
        } else {
            $(".tab-content").find(".read-more").addClass("d-none");
        }
    });

    jQuery(".read-more").on("click", function(event) {
        if ($(".read-more").hasClass("more")) {
            $(this).removeClass("more").addClass("less");
            $(this).html(
                '<span>Thu gọn <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="chevron-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-chevron-up fa-w-14"><path fill="currentColor" d="M6.101 359.293L25.9 379.092c4.686 4.686 12.284 4.686 16.971 0L224 198.393l181.13 180.698c4.686 4.686 12.284 4.686 16.971 0l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L232.485 132.908c-4.686-4.686-12.284-4.686-16.971 0L6.101 342.322c-4.687 4.687-4.687 12.285 0 16.971z" class=""></path></svg></span>'
            );
        } else {
            $(this).removeClass("less").addClass("more");
            $(this).html(
                '<span>Xem thêm <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-chevron-down fa-w-14"><path fill="currentColor" d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z" class=""></path></svg></span>'
            );
            $("html, body").animate({
                    scrollTop: $("#content").offset().top,
                },
                200
            );
        }

        jQuery(".tab-content .rte").toggleClass("expand");
    });

    $('.cart-drop .icon').click(function() {
        $('.cart-sidebar, .backdrop__body-backdrop___1rvky').addClass('active');
    });
    $(document).on('click', '.backdrop__body-backdrop___1rvky, .cart_btn-close', function() {
        $('.backdrop__body-backdrop___1rvky, .cart-sidebar, #popup-cart-desktop, .popup-cart-mobile')
            .removeClass('active');
        return false;
    })
    $(document).on("click", ".qv_add_to_cart", function(evt) {
        evt.preventDefault();
        $("#quick-view-product").hide();
        var $this = $(this);
        var form = $this.parents("form");
        $.ajax({
            type: "POST",
            url: "/cart/add.js",
            async: false,
            data: form.serialize(),
            dataType: "json",
            beforeSend: function() {},
            success: function(line_item) {
                $(".cart-popup-name")
                    .html(line_item.title)
                    .attr("href", line_item.url, "title", line_item.title);
                ajaxCart.load();
                if (typeof callback === "function") {
                    callback(line_item, form);
                    $(".cart-sidebar, .backdrop__body-backdrop___1rvky").addClass(
                        "active"
                    );
                    //AddCartMobile(line_item);
                } else {
                    Bizweb.onItemAdded(line_item, form);
                    $(".cart-sidebar, .backdrop__body-backdrop___1rvky").addClass(
                        "active"
                    );
                    //AddCartMobile(line_item);
                }
            },
            cache: false,
        });
    });
    function updatecart(t){
            var id= $(t).parents(".quantity").attr("data-id");
            var quantity = $(t).parents(".quantity").find("#qtym_"+id).val();
            console.log(id+"-"+quantity);

            $.ajax({
                url: '{{ route('frontend.order.cart.update') }}',
                method: "PATCH",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
</script>
@isset($web_information->source_code->footer)
    {!! $web_information->source_code->footer !!}
@endisset
