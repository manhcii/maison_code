@if ($block)
    @php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $image = $block->image != '' ? $block->image : url('demos/barber/images/icons/comb3.svg');
        $background = $block->image_background != '' ? $block->image_background : url('demos/seo/images/sections/5.jpg');
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
        
        $params['status'] = App\Consts::TAXONOMY_STATUS['active'];
        $params['taxonomy'] = App\Consts::TAXONOMY['product'];
        $params['is_featured'] = true;
        $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params)->get();
        // dd($taxonomys);
    @endphp
    <section class="section_category">
        <div class="container">
            <div class="cate-list row">
                @foreach ($taxonomys as $item)
                    {{-- @if ($item->parent_id == 'null' || $item->parent_id == '') --}}
                    @php
                        $params_post['status'] = App\Consts::POST_STATUS['active'];
                        $params_post['is_type'] = App\Consts::POST_TYPE['product'];
                        $params_post['taxonomy_id'] = $item->id;
                        if ($item->sub_taxonomy_id != null) {
                            $str_taxonomy_id = $item->id . ',' . $item->sub_taxonomy_id;
                            $params_post['taxonomy_id'] = array_map('intval', explode(',', $str_taxonomy_id));
                        } else {
                            $params_post['taxonomy_id'] = $item->id;
                        }
                        
                        $rows = App\Http\Services\ContentService::getCmsPost($params_post)->get();
                        
                        $title = $item->json_params->title->{$locale} ?? $item->title;
                        $image = $item->json_params->image != '' ? $item->json_params->image : null;
                        // Viet ham xu ly lay slug
                        $alias = App\Helpers::generateRoute($item->taxonomy, $item->alias ?? $item->title, $item->id);
                    @endphp
                    <div class="col-xl-2 col-lg-2 col-4">
                        <div class="swiper-slide">
                            <div class="cate-item">
                                <a class="image" href="{{ $alias }}" title="Gạo">
                                    <img class="image_cate_thumb lazyload" width="100" height="100"
                                        src="{{ asset('images/load.gif') }}" data-src="{{ $image }}"
                                        alt="{{ $title }}" />
                                </a>
                                <div class="hiden">
                                    <span class="count_sp"> {{ count($rows) }} </span>

                                    <span>{{ $title }}</span>
                                </div>
                            </div>
                            <h4 class="title_cate_">
                                <a href="{{ $alias }}" title="{{ $title }}">{{ $title }}</a>
                            </h4>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endforeach
            </div>
        </div>
    </section>
@endif
