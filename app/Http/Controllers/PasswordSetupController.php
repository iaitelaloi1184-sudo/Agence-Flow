<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordSetupController extends Controller
{
    public function show(User $user)
    {
        return view('auth.password-setup', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Mot de passe défini avec succès, vous pouvez vous connecter.');
    }
}