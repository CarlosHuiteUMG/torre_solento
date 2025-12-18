<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ResidentProfile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'full_name' => ['required', 'string', 'max:150'],
            'dpi' => ['required', 'string', 'max:25'],
            'apartment_number' => ['required', 'string', 'max:15'],
            'floor' => ['required', 'string', 'max:20'],
            'resident_type' => ['required', 'in:propietario,inquilino'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('residente');

        ResidentProfile::create([
            'user_id' => $user->id,
            'full_name' => $validated['full_name'],
            'dpi' => $validated['dpi'],
            'apartment_number' => $validated['apartment_number'],
            'floor' => $validated['floor'],
            'resident_type' => $validated['resident_type'],
            'phone' => $validated['phone'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
