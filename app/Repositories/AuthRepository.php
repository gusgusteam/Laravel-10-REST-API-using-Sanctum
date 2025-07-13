<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return Auth::user()->load('roles');
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

    public function update(array $data)
    {
        $user = $this->getAuthenticatedUser();
            // Verificar si se subió una nueva imagen
        if (!empty($data['image'])) {
            // Eliminar imagen anterior si existe
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            // Procesar y guardar la nueva imagen
            preg_match("/^data:image\/(\w+);base64,/", $data['image'], $matches);
            $extension = $matches[1] ?? 'png'; 
            $base64 = preg_replace("/^data:image\/\w+;base64,/", '', $data['image']);
            $base64 = str_replace(' ', '+', $base64); 
            $decoded = base64_decode($base64);
            $fileName = 'imagen_' . Str::random(20) . '.' . $extension;
            Storage::disk('public')->put('User/' . $fileName, $decoded);        
            $data['image'] = 'User/' . $fileName;
        }else{
            $data['image'] = $user->image; // Mantener la imagen anterior si no se proporciona una nueva
        }
        $user->update($data);
        return $user;
    }
}
