<?php 

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User $user
    ){
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function create(array $data): User {
        return $this->user->create($data);
    }

    public function authenticate($email, $password) {

    }

    public function findByEmail($email) 
    {
        return $this->user->where('email', $email)->first();
    }
}