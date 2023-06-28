<?php

namespace Src\main\Entities;

use JetBrains\PhpStorm\ArrayShape;

/**
 * @property string|null $lastName
 * @property string|null $firstName
 * @property string|null $surName
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $uuid
 * @property string|null $fullName
 */
class User implements \JsonSerializable
{
    public function __construct(
        private ?string $lastName = '',
        private ?string $firstName = '',
        private ?string $surName = '',
        private ?string $phone = '',
        private ?string $address = '',
        private ?string $city = '',
        private ?string $uuid = null,
        private ?string $fullName = '',
    )
    {
        //
    }

    public function __get(string $name)
    {
        return $this->{$name};
    }

    #[ArrayShape([
        'lastName' => "null|string",
        'firstName' => "null|string",
        'surName' => "null|string",
        'phone' => "null|string",
        'address' => "null|string",
        'city' => "null|string",
        'uuid' => "null|string",
        'fullName' => "null|string",
    ])]
    public function jsonSerialize(): array
    {
        return [
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'surName' => $this->surName,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'uuid' => $this->uuid,
            'fullName' => $this->fullName,
        ];
    }
}
