<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int)$user->id,
            'name' => (string)$user->name,
            'email' => (string)$user->email,
            'isVerified' => (int)$user->verified,
            'isAdmin' => ($user->admin === 'true'),
            'creationDate' => (string)$user->create_at,
            'lastChange' => (string)$user->updated_at,
            'deletedDate' => isset($user->create_at) ? (string) $user->deleted_at : null, 

            

            'links' => [

                [
                'rel' => 'self',
                'href' => route('users.show', $user->id),
                ],
            ]

        ];



    }

    public static function originalAttribute($index){
                $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'isAdmin' => 'admin',
            'creationDate' => 'create_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',

        ];

        // here we make sure that only the attributes here are received so if something like the password is used we will just return null
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
