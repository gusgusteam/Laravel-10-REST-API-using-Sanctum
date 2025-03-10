<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['ci']);
        return $this->userRepository->create($data);
    }
    public function loginUser(array $credentials)
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }
        // Generar token
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function getAll()
    {
        return $this->userRepository->all();
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function create2($data)
    {
        return $this->userRepository->create2($data);
    }

    public function update($id, $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }

    public function restore($id)
    {
        return $this->userRepository->restore($id);
    }
}
