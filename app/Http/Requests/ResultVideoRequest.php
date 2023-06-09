<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultVideoRequest extends FormRequest
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
            'video' => 'required|mimes:mp4,mov,MOV,jpg'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Загрузка файла является обязательным',
            'mimes' => 'Недопустимый формат файла'
        ];
    }
}
