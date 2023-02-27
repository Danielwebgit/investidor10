<?php

namespace App\Services\User;

use App\Models\User;

class UserService
{
    public function __construct(private User $model)
    {}

    public function store(array $userData)
    {
        $credentials = [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => bcrypt($userData['password'])
        ];

        return $this->model->create($credentials);
    }

}
