<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
         return [
            'identifier' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'stock' => (int)$product->quantity,
            'situation' => (string)$product->status,
            'picture' => url("img/{$product->image}"),
            'seller' => (int)$product->seller_id,
            'creationDate' => (string)$product->created_at,
            'lastChange' => (string)$product->updated_at,
            'deletedDate' => isset($product->deleted_at) ? (string) $product->deleted_at : null,
            
            
        
            'links' => [

                [
                'rel' => 'self',
                'href' => route('products.show', $product->id),
                ],
                [
                'rel' => 'product.buyers',
                'href' => route('products.buyers.index', $product->id),
                ],
                [
                'rel' => 'product.categories',
                'href' => route('products.categories.index', $product->id),
                ],
              
                [
                'rel' => 'product.transactions',
                'href' => route('products.transactions.index', $product->id),
                ],

                [
                    'rel' => 'seller',
                    'href' => route('sellers.show', $product->seller_id),
                ]
                
            ]
            

        ];
    }
        
     public static function originalAttribute($index){
                $attributes = [
            'id' => 'identifier',
             'name'=> 'title',
             'description' => 'details',
            'quantity'=> 'stock',
             'status' => 'situation',
            'image' => 'picture',
             'seller_id' => 'seller',
            'create_at'=>'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at'=>'deletedDate' ,

        ];

        // here we make sure that only the attributes here are received so if something like the password is used we will just return null
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }


}
