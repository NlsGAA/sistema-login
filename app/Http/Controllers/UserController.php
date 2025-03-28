<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Permissions;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ){
    }

    public function index() 
    {
        try {
            $users = User::with('permissions')->where('is_admin', false)->get();
            
            $allPermissions = Permissions::all();
        
            foreach ($users as $user) {
                $userPermissions = $user->permissions->pluck('permission_name')->toArray();
                
                $user->permissions = $allPermissions->map(function($permission) use ($userPermissions) {
                    return [
                        'id'              => $permission->id,
                        'permission_name' => $permission->permission_name,
                        'has_permission'  => in_array(
                            $permission->permission_name,
                            $userPermissions
                        )
                    ];
                });
            }
        } catch (\Exception $e) {
            $err = [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];

            return view('permissions', compact('err', 'users'));
        }
        
        return view('permissions', compact('users'));
        
    }

    public function store(Request $request) 
    {
        try {
            $payload = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $this->userService->register($payload);
        } catch (\Exception $e) {
            $err = [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];

            return view('register', compact('err'));
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        try {
            $payload = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $this->userService->authenticate($payload['email'], $payload['password']);

            $isUserAuthenticate = Auth::user()->exists;
        } catch (\Exception $e) {
            $err = [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];

            return view('login', compact('err'));
        }

        if(!$isUserAuthenticate) {
            $err = [
                'status'  => 'error',
                'message' => 'Erro inesperado, nossos engenheiros já estão trabalhando nisso!'
            ];

            return view('login', compact('err'));
        }

        return redirect()->route('index');
    }

    public function delete($id)
    {
        try {
            User::find($id)->delete();
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 400);
        }

        return redirect()->route('index');
    }

    public function togglePermissions(Request $request)
    {
        try {
            $hasPermissions = $request->exists('permissions');

            if(!$hasPermissions) {
                $err = [
                    'status'  => 'error',
                    'message' => 'Você precisa selecionar pelo menos uma permissão'
                ];

                return view('permissions', compact('err'));
            }

            $payload = $request->validate([
                'user_id' => 'required',
                'permissions' => 'required'
            ]);
            
            $user = User::find($payload['user_id']);

            $user->permissions()->sync($payload['permissions']);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 400);
        }

        return redirect()->route('index');
    }
}
