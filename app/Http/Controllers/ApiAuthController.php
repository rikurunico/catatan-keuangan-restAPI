<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //get user info
            $user = User::where('email', $request->email)->first();
            //generate Token
            $token = $user->createToken('my-app-token')->plainTextToken;
            //return response json dengan spesifikasi 
            // status, contoh : true or false
            // data, contoh : token login
            // message, contoh : login berhasil/gagal

            return ([
                'status' => true,
                'data' => [
                    'token' => $token,
                    'user' => new LoginResource($user),
                ],
                'message' => 'Login Berhasil'
            ]);
        } else {
            return ([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //generate Token
        $token = $user->createToken('my-app-token')->plainTextToken;

        //return response json dengan spesifikasi 
        // status, contoh : true or false
        // data, contoh : token Register
        // message, contoh : Register berhasil/gagal

        return ([
            'status' => true,
            'data' => [
                'token' => $token,
                'user' => new LoginResource($user),
            ],
            'message' => 'Register Berhasil'
        ]);
    }

    public function logout(Request $request)
    {
        // Hapus token yang aktif
        // $request->user()->currentAccessToken()->delete();

        // Hapus semua token by user
        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}
