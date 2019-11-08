<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryBuyerController extends ApiController
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
    public function index(Category $category)
    {
        $buyers = $category->products()
             ->whereHas('transactions')
             ->with('transactions.buyer')
             ->get()
             ->pluck('transactions') //we could have done pluck('transactions.buyer) but this will not work because
             //we basically will obtain several collections into one and if we use it laravel 
             // will not be able to localise the buyers in everyone of those collections
             ->collapse() // so we first receive a unique only long collections
             ->pluck('buyer') //then now we use this to obtain the full list of long transations
             ->unique('id') // use this to get unique values
             ->values(); // when it finds repeated values it will leave empty spaces, this will remove those empty spaces

             return $this->showAll($buyers);

    }

}
