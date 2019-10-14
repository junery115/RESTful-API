<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;


class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
         return [
            'identifier' => (int)$buyer->id,
            'name' => (string)$buyer->id,
            'email' => (string)$buyer->email,
            'isVerified' => (int)$buyer->verified,
            'creationDate' => (string)$buyer->created_at,
            'lastChange' => (string)$buyer->updated_at,
            'deletedDate' => isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null, 

        ];
        
    }
    public static function originalAttribute($index){
        $attributes = [
         'identifier' => 'id',
        'name' => 'name',
        'email' => 'email',
        'isVerified' => 'verified',
        'creationDate' => 'create_at',
        'lastChange' => 'updated_at',
        'deletedDate' => 'deleted_at',

         ];

// here we make sure that only the attributes here are received so if something like the password is used we will just return null
            return isset($attributes[$index]) ? $attributes[$index] : null;
      }
}
