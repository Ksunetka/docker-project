<?php

namespace App\Repositories;

use App\Models\User as Model;
use App\Repositories\Factories\UserFactory;
use Src\main\Entities\User;

class UsersRepository
{
    /**
     * @return array
     */
    public function get(): array
    {
        $models = Model::all();

        return $models->map(fn($model) => $this->mapModelToEntity($model))->toArray();
    }

    /**
     * @param string $uuid
     * @return User
     */
    public function getByUuid(string $uuid): User
    {
        $model = Model::firstWhere(['uuid' => $uuid]);

        return $this->mapModelToEntity($model);
    }

    /**
     * @param User $user
     * @return User
     */
    public function createOrUpdate(User $user): User
    {
        $model = Model::updateOrCreate(
            ['uuid' => $user->uuid],
            [
                'name' => $user->fullName,
                'phone' => $user->phone,
                'address' => $user->address,
                'city' => $user->city,
            ]
        );

        return $this->mapModelToEntity($model);
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool
    {
        return (bool)Model::firstWhere(['uuid' => $uuid])->delete();
    }

    /**
     * @param Model $model
     * @return User
     */
    private function mapModelToEntity(Model $model): User
    {
        $factory = new UserFactory();

        return $factory->build($model);
    }
}
