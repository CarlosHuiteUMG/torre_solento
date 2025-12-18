<?php

namespace App\Http\Controllers;

use App\Models\ResidentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = ResidentProfile::firstOrCreate(['user_id' => Auth::id()]);
        return view('user.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'dpi' => ['required', 'string', 'max:25'],
            'apartment_number' => ['required', 'string', 'max:15'],
            'floor' => ['required', 'string', 'max:20'],
            'resident_type' => ['required', 'in:propietario,inquilino'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        ResidentProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return back()->with('status', 'Perfil actualizado');
    }
}
