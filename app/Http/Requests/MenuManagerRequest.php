<?php

namespace Asterisk\Http\Requests;

use Asterisk\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class MenuManagerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method) {
            case 'POST':
                return [
                    'title' => 'required|string|unique:site_menus,title'
                ];
            case 'PATCH':
                return [
                    'title' => 'required|string'
                ];
        }
    }
}
