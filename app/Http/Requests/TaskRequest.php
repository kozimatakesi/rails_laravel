<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Task;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'max:10',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => ':attributeは10文字以内です。',
        ];
    }

    public function attributes()
    {
        return [
            'textbox' => 'テキストボックス',
            'textarea' => 'テキストエリア',
            'radiobtn' => 'ラジオボタン',
            'select' => 'セレクトボックス',
            'checkbox' => 'チェックボックス',
        ];
    }
}
