<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string|null $lastName
 * @property-read string|null $firstName
 * @property-read string|null $surName
 * @property-read string|null $phone
 * @property-read string|null $address
 * @property-read string|null $city
 * @property-read string|null $uuid
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'surName' => 'required|string|max:255',
            'phone' => 'required|string|max:30|regex:/^\+?[0-9]\d{10}$/',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле обязательно для заполнения',
            'string' => 'Поле должно быть строкой.',
            'max'  => 'Количество символов в поле не может превышать :max.',
            'regex' => 'Телефон должен иметь формат формат.',
        ];
    }
}
