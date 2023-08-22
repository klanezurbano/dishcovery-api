<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->username)->first();

            $token = null;
            if ($user->role === 'admin') {
                $token = $user->createToken('admin-token', ['getUsers']);
            } else {
                $token = $user->createToken('regular-token', ['createRecipe', 'editRecipe', 'deleteRecipe']);
            }

            return response()->json([
                'success' => true,
                'messsage' => 'Successfully logged in',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'token' => $token->plainTextToken
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Username and password does not match',
            ]);
        }
    }
}
