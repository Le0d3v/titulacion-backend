<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginRequest $request) {
        $data = $request->validated();

        if (!Auth::attempt([
            "matricula" => $data["matricula"],
            "password" => $data["password"]
        ])) {
            return response([
                "errors" => ["Credenciales de acceso incorrectas"]
            ], 422);
        }

        $user = Auth::user();
        
        return [
            "token" => $user->createToken("token")->plainTextToken,
            "user" => $user
        ];
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            "user" => null
        ];
    }
}
