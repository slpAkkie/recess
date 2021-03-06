<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function messages()
    {
        return [
            'date.required'     => 'Поле Дата бронирования должно быть заполненым',
            'date.date'         => 'Дата бронирования некорректна',
            'date.after'        => 'Дата бронирования не должна быть раньше сегодня',
            'duration.required' => 'Поле длительность съемки должно быть заполненым',
            'duration.integer'  => 'Длительность съемки должно быть числом',
            'duration.min'      => 'Минимальная длительность съемки 1 час',
        ];
    }

    public function rules()
    {
        return [
            'date'      => 'required|date|after:today',
            'duration'  => 'required|integer|min:1',
        ];
    }
}
