<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'index']);
    }

    public function ingresar(Request $request)
    {
        try {
            $username = $request->input('LoginForm.username');
            $password = $request->input('LoginForm.password');
            $remember = $request->boolean('remember');

            // Validación
            $validator = Validator::make([
                'username' => $username,
                'password' => $password
            ], [
                'username' => 'required|string|max:255',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => '1',
                    'msj' => 'Campos requeridos',
                    'errores' => $validator->errors()
                ], 422);
            }

            // Intento de autenticación con validación de estado activo
            $user = User::where('username', $username)
                ->where('activo', 1) // Solo se permite si el usuario está activo
                ->first();

            if ($user && Hash::check($password, $user->password)) {
                // Autenticación exitosa
                Auth::login($user, $remember);
                $request->session()->regenerate();

                // Actualizar último acceso
                $user->update(['ultimo_acceso' => now()]);

                Log::info('Login exitoso: ' . $username);

                return response()->json([
                    'error' => '0',
                    'msj' => 'Bienvenido ' . $user->nombre,
                    'redirect' => route('site.index')
                ]);
            }

            // Si el usuario no está activo o las credenciales son incorrectas
            Log::warning('Intento fallido: ' . $username);

            return response()->json([
                'error' => '1',
                'msj' => 'Credenciales incorrectas o usuario inactivo'
            ], 401);

        } catch (\Exception $e) {
            Log::error('Error en login: ' . $e->getMessage());

            return response()->json([
                'error' => '1',
                'msj' => 'Error en el servidor',
                'debug' => config('app.debug') ? $e->getMessage() : ''
            ], 500);
        }
    }


    public function index()
    {
        try {

            if (Auth::check()) {
                $user = Auth::user();

                if (!$user->activo) {
                    Auth::logout();
                    return view('site.login', [
                        'title' => 'Iniciar Sesión',
                        'year' => date('Y'),
                        'error' => 'Usuario inactivo'
                    ]);
                }

                return view('site.index', [
                    'modo' => 'cli',
                    'user' => $user
                ]);
            }

            return view('site.login', [
                'title' => 'Iniciar Sesión',
                'year' => date('Y')
            ]);

        } catch (\Exception $e) {
            Log::error('Error en index: ' . $e->getMessage());

            return view('site.login', [
                'title' => 'Iniciar Sesión',
                'year' => date('Y'),
                'error' => config('app.debug') ? $e->getMessage() : 'Error en el servidor'
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            if (Auth::check()) {
                $username = Auth::user()->username;

                Auth::user()->update([
                    'ultimo_logout' => now()
                ]);

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Log::info('Logout exitoso: ' . $username);
            }

            return redirect('/');

        } catch (\Exception $e) {
            Log::error('Error en logout: ' . $e->getMessage());
            return redirect('/');
        }
    }
}
