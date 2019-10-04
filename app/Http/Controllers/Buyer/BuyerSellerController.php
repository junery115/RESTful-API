<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        //using eager loading we can get the list of transactions with the products of each of them and each of those products
        //sends back their sellers 
        $sellers = $buyer->transactions()->with('product.seller')
        ->get()
        ->pluck('product.seller')
        ->unique('id') // because we can't have repeated sellers we use the unique() method
        ->values();// recreates the collection and takes out empty spaces that remain when the unique method removes repeated objects.
        return $this->showAll($sellers);
        
    }

    
}
