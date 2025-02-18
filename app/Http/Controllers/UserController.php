<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Mostra la lista degli utenti (non modificato)
    public function index()
    {
        return response()->json(User::all());
    }

    // Mostra il form per creare un nuovo utente
    public function create()
    {
        return view('admin.users.create'); // Assicurati di avere la vista 'create.blade.php'
    }

    // Salva un nuovo utente
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'user_type' => 'required|in:cliente,fornitore'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        return redirect()->route('admin.users.create')->with('success', 'Utente aggiunto con successo!');
    }

    // Mostra il form per modificare un utente
    public function edit($id)
    {
        $user = User::findOrFail($id); // Trova l'utente o mostra un errore 404
        return view('admin.users.edit', compact('user')); // Passa l'utente alla vista
    }

    // Aggiorna un utente esistente
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Utente non trovato'], 404);
        }

        // Validazione
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'user_type' => 'required|in:cliente,fornitore'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Aggiornamento
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'user_type' => $request->user_type,
        ]);

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Utente aggiornato con successo!');
    }

    // Elimina un utente
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utente non trovato'], 404);
        }

        $user->delete();
        return redirect()->route('admin.users.create')->with('success', 'Utente eliminato con successo!');
    }
}
