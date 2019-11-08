<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;



class SellerCategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
       $categories = $seller ->products()
               ->whereHas('categories')// because there could exist a product without category
               ->with('categories')
               ->get()
               ->pluck('categories') //creates a collection only with categories
               ->collapse() // this is because a product should have several categories, so it will be a collection with a collection inside
               ->unique('id') // this will enable so that the categories are not repeated
               ->values();
        return $this->showAll($categories);

    }


}
