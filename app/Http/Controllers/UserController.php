<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ){
    }

    public function index() {
        try {
            $allUsers = $this->userService->index();

            $users = UserResource::collection($allUsers);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 400);
        }

        return view('permissions', compact('users'));
    }

    public function store(Request $request) {
        try {
            $payload = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $this->userService->register($payload);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'success',
                'message' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Usuário cadastrado com sucesso!'
        ], 201);
    }

    
}
