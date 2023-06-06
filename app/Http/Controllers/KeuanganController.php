<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeuanganRequest;
use App\Http\Requests\UpdateKeuanganRequest;
use App\Models\Keuangan;
use App\Models\User;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeuanganRequest $request)
    {
        $keuangan = Keuangan::create($request->all());

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $keuangan->id,
                'user' => $keuangan->user->name,
                'category' => $keuangan->category,
                'amount' => $keuangan->amount,

            ],
            'message' => 'Success Adding Financial Record',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeuanganRequest $request, Keuangan $keuangan)
    {
        $keuangan->update($request->all());

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $keuangan->id,
                'user' => $keuangan->user->name,
                'category' => $keuangan->category,
                'amount' => $keuangan->amount,

            ],
            'message' => 'Success Updating Financial Record',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keuangan $keuangan)
    {
        //
    }

    public function getKeuangan(Request $request)
    {
        $users = User::with('keuangan')->get();

        return response()->json([
            'status' => true,
            'data' => $users,
            'message' => 'Success Get User and Financial Records',
        ]);
    }
}
