<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Users\User;
use App\Repositories\Eloquent\Repository;

class UserRepository extends Repository
{
    protected $modelClass = User::class;

    public function prepareData($data)
    {
        if (array_key_exists('password', $data)){
            $data['password'] = bcrypt($data['password']);
            return $data;
        }
    }
}