<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;

class PasswordController extends Controller
{
    public function update(PasswordRequest $password_request,) {
        $data = $password_request->validated(); 

        $user = User::find($data["id"]);

        if (!Hash::check($data["current_password"], $user->password)) {
            return response([
                "errors" => ["La contraseña actual es incorrecta"],
            ], 422);
        }

        $user->password = $data["password"];
        $user->save();

        return [
            "status" => 200,
            "message" => "Contraseña Actualizada"
        ];
    }
}
