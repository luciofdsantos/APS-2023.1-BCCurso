<?php

namespace App\Http\Controllers;

use App\Models\Servidor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ServidorController extends Controller
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
    public function store(Request $request)
    {
        $usuarioExists = User::where('email', $request->email)->exists();
        $servidorExists = Servidor::where('email', $request->email)->exists();

        if ($usuarioExists || $servidorExists) {
            // Usuário ou servidor com login ou e-mail já existente
            $usuarios = User::all();
            return response()->json(['error' => 'Usuario já cadastrado', 'usuarios' => $usuarios]);
        }

        $user = User::create([
            'name' => $request->nome,
            'password' => Hash::make($request->email),
            'email' => strtolower($request->email),
        ]);

        $servidor = Servidor::create([
            'nome' => $request->nome,
            'email' => strtolower($request->email),
            'user_id' => $user->id,
        ]);

        $servidores = Servidor::whereNotIn('id', function ($query) {
            $query->select('servidor_id')->from('professor');
        })->get();

        return response()->json(['servidores' => $servidores]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
