<?php

namespace App\Application\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Domain\Repositories\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthRepository implements AuthRepositoryInterface
{
    public function register($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return [
            'user' => $user,
        ];
    }

    public function login($request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw new \Exception('As credenciais estão incorretas.', 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return ['token' => $token];
    }
}
