<?php

namespace App\Http\Controllers\Admin;

use App\Consts;
use App\Http\Services\ContentService;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->routeDefault  = 'review';
        $this->viewPart = 'admin.pages.reviews';
        $this->responseData['module_name'] = __('Review Management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->responseData['module_name'] = __('Review Management');
        $params = $request->all();

        $this->responseData['params'] = $params;
        $rows = ContentService::getReview($params)->paginate(Consts::DEFAULT_PAGINATE_LIMIT);
        $this->responseData['rows'] =  $rows;

        return $this->responseView($this->viewPart . '.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CmsCategory  $cmsCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        $this->responseData['module_name'] = __('Review Management');
        $this->responseData['detail'] = $review;

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review  $review)
    {
        $this->responseData['detail'] = $review;
        return $this->responseView($this->viewPart . '.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review  $review)
    {
        $params = $request->all();
        $review->fill($params);
        $review->save();
        return redirect()->back()->with('successMessage', __('Successfully updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmsProduct  $cmsProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->status = Consts::STATUS_DELETE;
        $review->save();

        return redirect()->route($this->routeDefault . '.index')->with('successMessage', __('Delete record successfully!'));
    }
}
