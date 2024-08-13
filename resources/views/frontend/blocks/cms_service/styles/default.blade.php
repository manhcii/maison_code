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

        $rows = App\Http\Services\ContentService::getCmsPost($params)->get();

    @endphp

    <div class="mt-6">
        <div class="container clearfix">
            <div class="row col-mb-50">
                @foreach ($rows as $item)
                    @php
                        $title = $item->json_params->title->{$locale} ?? $item->title;
                        $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                        $icon = $item->json_params->icon ?? '';
                        $content = $item->json_params->content->{$locale} ?? $item->content;
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
                                <a href="{{$alias}}"><i class="{{ $icon }}"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3 class="fw-normal">{{ $title }}</h3>
                                <p>{{$brief}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="line"></div>
        </div>
    </div>
@endif
