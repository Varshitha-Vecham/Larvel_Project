<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the local password reset view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Reset a password directly without sending an email link.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where('email', $request->input('email'))->firstOrFail();

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('login')
            ->with('status', 'Password reset successfully. Please log in.');
    }
}
