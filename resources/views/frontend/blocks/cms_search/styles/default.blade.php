@if ($block)
    @php

        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $content = $block->json_params->content->{$locale} ?? $block->content;
        $background = $block->image_background != '' ? $block->image_background : url('assets/img/banner.jpg');
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;

        // Filter all blocks by parent_id
        $block_childs = $blocks->filter(function ($item, $key) use ($block) {
            return $item->parent_id == $block->id;
        });

        $params['status'] = App\Consts::POST_STATUS['active'];
        $params['is_featured'] = true;
        $params['is_type'] = App\Consts::POST_TYPE['service'];

        // $rows = App\Http\Services\ContentService::getCmsPost($params)->get();

    @endphp


    <div class="tabs advanced-real-estate-tabs clearfix">
        <div class="container clearfix">
            <ul class="tab-nav clearfix">
                <li><a href="#tab-properties" data-scrollto="#tab-properties" data-offset="133">Tìm kiếm</a></li>
            </ul>
        </div>

        <div class="tab-container">
            <div class="container clearfix">
                <div class="tab-content clearfix" id="tab-properties">
                    <form action="{{ route('frontend.search') }}" method="GET" class="mb-0">
                        <div class="row">

                            <div class="col-lg-2 col-md-12 bottommargin-sm">
                                <label style="display:block;">Loại</label>
                                <input type="hidden"name="type_ck" value="1">
                                <input class="bt-switch" name="type" value="2" type="checkbox" checked
                                    data-on-text="Mua" data-off-text="Thuê" data-on-color="themecolor"
                                    data-off-color="themecolor">
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 bottommargin-sm">
                                <label>Khu vực</label>
                                <select class="selectpicker" name="city" data-live-search="true"
                                    data-placeholder="Chọn khu vực" data-size="6" style="width:100%;">
                                    @foreach ($city as $key => $val)
                                        <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6 bottommargin-sm">
                                <label>Phòng ngủ</label>
                                <select class="selectpicker" name="bedr" data-size="6"
                                    data-placeholder="Vui lòng chọn" style="width:100%; line-height: 30px;">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5+</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-6 bottommargin-sm">
                                <label>Phòng tắm</label>
                                <select class="selectpicker" name="bathr" data-size="6"
                                    data-placeholder="Vui lòng chọn" style="width:100%; line-height: 30px;">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5+</option>
                                </select>
                            </div>
                            <input type="hidden" id="rg_price" name="price" value="">
                            <input type="hidden" id="rg_spft" name="spft" value="">
                            <div class="w-100"></div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <label style="margin-bottom: 20px !important;">Giá</label>
                                <input class="price-range-slider" type="range">
                            </div>
                            <div class="w-100 d-block d-md-none bottommargin-sm"></div>
                            <div class="col-lg-4 offset-lg-1 col-md-6 col-12">
                                <label style="margin-bottom: 20px !important;">Diện tích</label>
                                <input class="area-range-slider" type="range">
                            </div>
                            <div class="offset-lg-1 col-lg-2 col-md-12 clearfix">
                                <button class="button button-3d button-rounded w-100 m-0"
                                    style="margin-top: 35px !important;">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
