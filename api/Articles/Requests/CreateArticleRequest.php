<?php

namespace Api\Articles\Requests;

use Infrastructure\Http\ApiRequest;

class CreateArticleRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user' => 'array|required',
            'user.email' => 'required|email',
            'user.name' => 'required|string',
            'user.password' => 'required|string|min:8'
        ];
    }

    public function attributes()
    {
        return [
            'user.email' => 'the user\'s email'
        ];
    }
}
