<?php

namespace App\Repositories\Factories;

use App\Models\User as Model;
use Src\main\Entities\User;

class UserFactory
{
    /**
     * @param Model $model
     * @return User
     */
    public function build(Model $model): User
    {
        $arFullName = explode(" ", $model->name);

        $firstName = trim($arFullName[1]);
        $lastName = trim($arFullName[0]);
        $surName = trim($arFullName[2]);

        return new User(
            lastName: $lastName,
            firstName: $firstName,
            surName: $surName,
            phone: $model->phone,
            address: $model->address,
            city: $model->city,
            uuid: $model->uuid,
            fullName: $model->name,
        );
    }

    /**
     * @param array $array
     * @return User
     */
    public function buildFromArray(array $array): User
    {
        $fullName = $array['lastName'] . ' ' . $array['firstName'] . ' ' . $array['surName'];

        return new User(
            lastName: $array['lastName'],
            firstName: $array['firstName'],
            surName: $array['surName'],
            phone: $array['phone'],
            address: $array['address'],
            city: $array['city'],
            uuid: $array['uuid'],
            fullName: $fullName,
        );
    }
}
