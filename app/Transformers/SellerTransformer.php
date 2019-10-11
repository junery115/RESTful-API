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
            'name' => (string)$seller->id,
            'email' => (string)$seller->email,
            'isVerified' => (int)$seller->verified,
            'creationDate' => (string)$seller->create_at,
            'lastChange' => (string)$seller->updated_at,
            'deletedDate' => isset($seller->create_at) ? (string) $seller->deleted_at : null, 
        ];
    }
}
