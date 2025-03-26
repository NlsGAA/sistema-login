<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){
    }

    public function index()
    {
        return $this->userRepository->getAll();
    }

    public function register(array $userData) {
        $userAlreadyExists = $this->userRepository->findByEmail($userData['email']);

        if($userAlreadyExists) {
            Throw new \Exception('Email has already been registered');
        }

        return $this->userRepository->create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password']
        ]);
    }

    public function authenticate($email, $password) {
        
    }
}
