<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data)
    {
        return User::create($data);
    }
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function all()
    {
        return User::all();
    }

    public function create2(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function destroy($id)
    {
        $user = $this->find($id);
        $user->update(['estado' => 0]);
        return $user;
    }

    public function restore($id)
    {
        $user = $this->find($id);
        $user->update(['estado' => 1]);
        return $user;
    }
}
