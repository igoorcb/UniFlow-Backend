<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Domain\Repositories\AuthRepositoryInterface;

class AuthController extends Controller
{
    protected AuthRepositoryInterface $authService;

    public function __construct(AuthRepositoryInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(AuthRequest $request)
    {
        $register= $this->authService->register($request);
        return response()->json([
            'message' => 'Usuário registrado com sucesso.',
            'user' => $register,
        ], 201);
    }

    public function login(Request $request)
    {
        try {
            $data = $this->authService->login($request);
            return response()->json([
                'message' => 'Login realizado com sucesso.',
                'token' => $data['token'],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 400);
        }
    }


    private function AuthRepositoryInterface()
    {
    }
}
