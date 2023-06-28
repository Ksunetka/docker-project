<?php

namespace App\Services;

use Src\main\Entities\User;

class UsersService
{
    /**
     * @param User[] $users
     * @return array
     */
    public function getFilters(array $users): array
    {
        return [
            'fullName' => array_map(fn(User $user) => $user->fullName, $users),
            'address' => array_map(fn(User $user) => $user->address, $users),
            'city' => array_map(fn(User $user) => $user->city, $users),
        ];
    }
}
