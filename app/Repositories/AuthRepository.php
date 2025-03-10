<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthRepository
{
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null;
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function logout()
    { 
        Auth::user()->tokens->each(function ($token) {
            $token->delete();
        });
    }

    public function updatePassword(User $user, string $currentPassword, string $newPassword)
    {
        if (Hash::check($currentPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
            return true;
        }

        return false;
    }

    public function sendPasswordResetLink(string $email)
    {
        return Password::sendResetLink(['email' => $email]);
    }

    public function resetPassword(string $email, string $token, string $newPassword)
    {
        return Password::reset(
            ['email' => $email, 'token' => $token, 'password' => $newPassword],
            function ($user) use ($newPassword) {
                $user->password = Hash::make($newPassword);
                $user->save();
            }
        );
    }
}
