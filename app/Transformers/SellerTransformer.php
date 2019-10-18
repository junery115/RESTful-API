<?php

namespace App\Transformers;


use App\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identifier' => (int)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'isVerified' => (int)$seller->verified,
            'creationDate' => (string)$seller->create_at,
            'lastChange' => (string)$seller->updated_at,
            'deletedDate' => isset($seller->create_at) ? (string) $seller->deleted_at : null, 
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
      public static function transformedAttribute($index){
        $attributes = [
         'id' => 'identifier' ,
         'name'=> 'name' ,
        'email' => 'email',
        'verified' => 'isVerified',
        'create_at' => 'creationDate',
        'updated_at' => 'lastChange',
        'deleted_at' => 'deletedDate',

         ];

// here we make sure that only the attributes here are received so if something like the password is used we will just return null
            return isset($attributes[$index]) ? $attributes[$index] : null;
      }
}
