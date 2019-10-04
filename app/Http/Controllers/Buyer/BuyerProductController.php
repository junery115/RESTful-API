<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        //first thing here is an error because a buyer has many transactions so the result is a collection
        //we use eager loading to obtain the product within each transaction, we will obtain the querry builder from the relationship
        // and not the relationship itself so we will call the method instead of the relationship. 
        // so before what we were dooing was just calling the relationship

        // calling the relationship
       //$products = $buyer->transactions->product;

        //calling the method
        $products = $buyer->transactions()->with('product')->get()->pluck('product');
        //then we use the plug method that goes inside our returned ccollection and obtains an index that we specifically give it
       // we ignore the other part of the collection and obtain only the product
       return $this->showAll($products);
    }

    
}
