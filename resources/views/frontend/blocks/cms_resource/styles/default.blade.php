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
        $params['is_type'] = App\Consts::POST_TYPE['resource'];

        $rows = App\Http\Services\ContentService::getCmsPost($params)->get();
        $i = 0;
    @endphp

    <div class="mt-6">
        <div class="container clearfix">
            <div class="row real-estate-properties clearfix">
                @foreach ($rows as $item)
                    @php
                        $i++;
                        $title = $item->json_params->title->{$locale} ?? $item->title;
                        $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                        $content = $item->json_params->content->{$locale} ?? $item->content;
                        $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                        $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->taxonomy_alias ?? $item->taxonomy_title, $item->taxonomy_id);
                        $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
                    @endphp
                    <div class="<?=($i==1)?"col-lg-7":(($i==2)?"col-lg-5":"col-lg-4")?>">
                        <a href="#"
                            style="background: url('{{$image}}') no-repeat bottom center; background-size: cover;">
                            <div class="vertical-middle dark center">
                                <div class="heading-block m-0 border-0">
                                    <h3 class="text-capitalize fw-medium">{{$title}}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
