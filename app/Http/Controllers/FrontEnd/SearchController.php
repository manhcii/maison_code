<?php

namespace App\Http\Controllers\FrontEnd;

use App\Consts;
use App\Region;
use App\Http\Services\ContentService;
use App\Models\CmsTaxonomy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function filter($slug = null, Request $request)
    {
        $params = $request->all();
        $params['status'] = Consts::POST_STATUS['active'];
        $params['is_type'] = Consts::POST_TYPE['product'];
        // $params['keyword'] = $slug ?? '';
        $posts = ContentService::getCmsPost($params)->get();
        $this->responseData['posts'] = $posts;
        $this->responseData['params'] = $params;
        // dd($this->responseData);
        return $this->responseView('frontend.pages.search.index');
    }
}
