<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\ResponseHelper;

class AuthController extends Controller
{
    /**
     * Acción de Login - Crear token y devolver token con claims y el user object.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return ResponseHelper::error(
                    message: 'No hemos encontrado estas credenciales en nuestro sistema.',
                    statusCode: 400
                );
            }

            $user = Auth::user();
            $claims = config('claims');
            $token = $user->createToken($user->email, $claims[$user->profile_id])->plainTextToken;
            $authenticatedUser = [
                'user' => $user,
                'token' => $token
            ];

            return ResponseHelper::success(message: 'Login exitoso!', data: $authenticatedUser, statusCode: 200);
        } catch (\Exception $e) {
            \Log::error('Unable to log in User : ' . $e->getMessage() . ' - Line number. ' . $e->getLine());
            return ResponseHelper::error(message: 'No logramos hacer el login. Intenta nuevamente.', statusCode: 500);
        }
    }

    /**
     * Acción para pedir el perfil del usuario
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        try {
            $user = Auth::user();

            if ($user) {
                return ResponseHelper::success(message: 'Perfil retrivido exitosamente', data: $user, statusCode: 200);
            }

            return ResponseHelper::error(message: 'No logramos encontrar tu usuario dado un token inválido.', statusCode: 400);
        } catch (\Exception $e) {
            \Log::error('Unable to fetch User data : ' . $e->getMessage() . ' - Line number. ' . $e->getLine());
            return ResponseHelper::error(message: 'No logramos procesar tu request.', statusCode: 500);
        }
    }

    /**
     * Acción para el logout del usuario
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return ResponseHelper::success(message: 'Sesión cerrada existosamente.', statusCode: 200);
    }
}
