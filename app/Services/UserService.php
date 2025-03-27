<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        if ($userAlreadyExists) {
            throw new \Exception('Email has already been registered');
        }

        $users = $this->userRepository->getAll();

        $isFirstUser = $users->isEmpty();

        $isAdmin = $isFirstUser ? true : false;

        $passwordHashed = Hash::make($userData['password']);

        return $this->userRepository->create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $passwordHashed,
            'is_admin' => $isAdmin,
        ]);
    }

    public function authenticate($email, $password) {
        
        $emailExists = $this->userRepository->findByEmail($email);

        if(!$emailExists) {
            Throw new \DomainException('Credentials dont match');
        }

        if(!Hash::check($password, $emailExists->password)) {
            Throw new \DomainException('Credentials dont match');
        }

        Auth::login($emailExists);
    }
}
