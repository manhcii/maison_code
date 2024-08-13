@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $image = $block->image!= '' ? $block->image: url('demos/barber/images/icons/comb3.svg');
        $background = $block->image_background != '' ? $block->image_background : url('demos/seo/images/sections/5.jpg');
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;

        $params['status'] = App\Consts::TAXONOMY_STATUS['active'];
        $params['taxonomy'] = App\Consts::TAXONOMY['pantner'];

        $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params)->get();

        $params['status'] = App\Consts::POST_STATUS['active'];
        $params['is_featured'] = true;
        $params['is_type'] = App\Consts::POST_TYPE['pantner'];
        $rows = App\Http\Services\ContentService::getCmsPost($params)
            ->limit(3)
            ->get();

    @endphp
    <div class="container clearfix" style="position: relative;">
        <div class="heading-block border-bottom-0">
            <h3>{{$title}}</h3>
        </div>

        <a href="{{$url_link}}" class="button button-small button-rounded button-border button-border-thin fw-medium m-0" style="position: absolute; top: 7px; right: 0.75rem;">{{$url_link_title}}</a>

        <div class="real-estate owl-carousel image-carousel carousel-widget bottommargin-lg" data-margin="10" data-nav="true" data-loop="true" data-pagi="false" data-items-xs="1" data-items-sm="1" data-items-md="2" data-items-lg="3" data-items-xl="3">
            @foreach ($rows as $item)
                    @php
                        $title = $item->json_params->title->{$locale} ?? $item->title;
                        $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                        $price = $item->json_params->price??null;
                        $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                        $date = date('H:i d/m/Y', strtotime($item->created_at));
                        // Viet ham xu ly lay slug
                        $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['pantner'], $item->taxonomy_title, $item->taxonomy_id);
                        $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['pantner'], $title, $item->id, 'detail', $item->taxonomy_title);
                    @endphp
                    <div class="oc-item">
                        <div class="real-estate-item">
                            <div class="real-estate-item-image">
                                <div class="label badge bg-danger">Giảm giá</div>
                                <a href="{{ $alias }}">
                                    <img src="{{ $image }}" alt="{{ $title }}">
                                </a>
                                <div class="real-estate-item-price">
                                    {{$price}}VNĐ<span>Cho thuê</span>
                                </div>
                                <div class="real-estate-item-info clearfix" data-lightbox="gallery">
                                    <a href="{{ $image }}" data-bs-toggle="tooltip" title="Hình ảnh" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                                    <a href="#"><i class="icon-line-heart"></i></a>                                </div>
                            </div>

                            <div class="real-estate-item-desc">
                                <h3><a href="#">{{ $title }}</a></h3>
                                <span>Khu vực Hà Nội</span>

                                <a href="#" class="real-estate-item-link"><i class="icon-info"></i></a>

                                <div class="line" style="margin-top: 15px; margin-bottom: 15px;"></div>

                                <div class="real-estate-item-features fw-medium font-primary clearfix">
                                    <div class="row g-0">
                                        <div class="col-lg-4 p-0">Phòng ngủ: <span class="color">3</span></div>
                                        <div class="col-lg-4 p-0">Phòng tắm: <span class="color">3</span></div>
                                        <div class="col-lg-4 p-0">Diện tích: <span class="color">150 m2</span></div>
                                        <div class="col-lg-4 p-0">Hồ bơi: <span class="text-success"><i class="icon-check-sign"></i></span></div>
                                        <div class="col-lg-4 p-0">Internet: <span class="text-success"><i class="icon-check-sign"></i></span></div>
                                        <div class="col-lg-4 p-0">Vệ sinh: <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@endif
