<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Consts;
use App\Region;
use App\Http\Services\ContentService;
use App\Http\Services\PageBuilderService;
use App\Http\Services\UserService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->responseData['city'] = Region::DATA;
        $this->responseData['Product_type'] = Consts::Product_type;
        $this->responseData['Type_price'] = Consts::type_price;
        $this->responseData['DataBedr'] = Consts::DataBedr;
        $this->responseData['DataBathr'] = Consts::DataBathr;
        return $this->responseView('frontend.pages.home.index');
    }
}
