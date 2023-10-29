<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
                return response()->json(['errors' => ['message' => 'Credenciales inválidas']], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['errors' => ['message' => 'No se pudo crear el token']], 500);
        }

        // El inicio de sesión fue exitoso, devuelve el token JWT y los datos del usuario y del cliente asociado
        $user = JWTAuth::user();
        $cliente = Cliente::where('usuario_id', $user->id)->first();

        return response()->json([
            'token' => $token,
            'user' => $user,
            'cliente' => $cliente, // Agrega los datos del cliente asociado aquí
            'rol' => $user->empleado->rol->nombre ?? 'Cliente' // Agrega los datos del empleado asociado aquí
        ]);
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'profesion' => 'string|max:50',
                'nit' => 'required|string|max:12',
                'telefono' => 'required|string|max:10',
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);
        } catch (ValidationException $e) {
            // La validación ha fallado
            $errors = $e->validator->errors()->messages();
            return response()->json(['errors' => $errors], 422);
        }

        try {
            // Crear un nuevo usuario
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password),
            ]);
            $user->save();

            // Crear un nuevo cliente
            Cliente::created([
                'usuario_id' => $user->id,
                'nit ' => $request->nit,
                'profesion ' => $request->profesion
            ]);

            return response()->json(['message' => 'Registro exitoso'], 201);

            // Opcional: Puedes generar un token JWT para el usuario registrado si deseas que inicien sesión automáticamente
            // use JWTAuth; // Importa JWTAuth al principio del controlador
            // $token = JWTAuth::fromUser($user);
        } catch (\Exception $e) {
            return response()->json(['errors' => ['message' => 'No se pudo registrar el usuario']], 500);
        }
    }

    public function logout()
    {
        try {
            // Invalidar el token actual y cerrar sesión del usuario
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Sesión cerrada con éxito']);
        } catch (JWTException $e) {
            return response()->json(['errors' => ['message' => 'No se pudo cerrar la sesión']], 500);
        }
    }
}
