<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Verificar las credenciales del usuario y generar un token JWT
            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }

        // El inicio de sesión fue exitoso, devuelve el token JWT y los datos del usuario
        $user = JWTAuth::user();

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout()
    {
        try {
            // Invalidar el token actual y cerrar sesión del usuario
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Sesión cerrada con éxito']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo cerrar la sesión'], 500);
        }
    }
}
