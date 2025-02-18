<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::paginate(10); // Recupera gli utenti con paginazione
        return view('admin.dashboard', compact('users'));
    }
}
