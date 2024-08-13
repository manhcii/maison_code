<div class="blog_left_base col-lg-4 col-12 order-lg-2">
  @php
            $params_product['status'] = App\Consts::POST_STATUS['active'];
            $params_product['is_type'] = App\Consts::POST_TYPE['post'];
            $params_product['order_by'] = 'count_visited';
            
            $mostViews = App\Http\Services\ContentService::getCmsPost($params_product)
                ->limit(App\Consts::PAGINATE['sidebar'])
                ->get();
        @endphp

@isset($mostViews)
<div class="blog_noibat">

  <h2 class="h2_sidebar_blog">
    <a href="tin-tuc.html" title="Bài viết nổi bật">Bài viết nổi bật</a>
</h2>
<div class="blog_content">

        @foreach ($mostViews as $item)
            @php
                $title = $item->json_params->title->{$locale} ?? $item->title;
                $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
                $date = date('H:i d/m/Y', strtotime($item->created_at));
                // Viet ham xu ly lay slug
                $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
            @endphp
            <div class="item clearfix">
              <div class="post-thumb">
                  <a class="image-blog scale_hover"
                      href="{{ $alias }}"
                      title="{{$title}}">
                      <img class="img_blog lazyload"
                          src="{{ asset('images/load.gif') }}"
                          data-src="{{ $image }}"
                          alt="{{$title}}" />
                  </a>
              </div>
              <div class="contentright">
                  <h3>
                      <a title="{{$title}}"
                          href="{{ $alias }}">Rau
                          {{ Str::limit($title, 50) }}</a>
                  </h3>
              </div>
          </div>
        @endforeach
    </div>
</div>

@endisset
   
