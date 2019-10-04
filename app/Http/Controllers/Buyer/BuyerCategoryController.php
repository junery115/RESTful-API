<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()->with('product.categories')
        ->get()
        ->pluck('product.categories')
        ->collapse()// create a unique collection from serveral collections we have inside
        ->unique('id') // because we can't have repeated sellers we use the unique() method
        ->values();// recreates the collection and takes out empty spaces that remain when the unique method removes repeated objects.
        return $this->showAll($categories);
    }

}
