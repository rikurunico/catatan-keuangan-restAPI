<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUsersRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        //API update profile (merubah data profile user) dengan ketentuan respon :
        // 1. status, contoh : true or false
        // 2. data, contoh : id dari user
        // 3. message, contoh : sukses/gagal

        $user->update($request->validated());

        return ([
            'status' => true,
            'data' => [
                'user' => new LoginResource($user),
            ],
            'message' => 'Success Update User Data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function GetUserInfo(Request $request)
    {
        return ([
            'status' => true,
            'data' => [
                'user' => new LoginResource($request->user()),
            ],
            'message' => 'Success Get User Data'
        ]);
    }
}
