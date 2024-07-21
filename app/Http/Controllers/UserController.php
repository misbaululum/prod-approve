<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Divisi;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('pages.user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = Divisi::all(); // Ambil semua divisi dari database

        return view('pages.user-form', [
            'action' => route('users.store'),
            'data' => new User(),
            'jenisKelamin' => [
                'Laki-laki' => 'L',
                'Perempuan' => 'P'
            ],
            'divisi' => $divisi, // Kirim data divisi ke view
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User($request->validated());
            $user->password = Hash::make($request->password);
            $user->save();

            $divisi = Divisi::find($request->divisi);
            $user->kagroup()->create([
                'nama' => $request->nama,
                'divisi_id' => $request->divisi,
                'nama_divisi' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 403);

        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
