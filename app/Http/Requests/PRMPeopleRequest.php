<?php

namespace Asterisk\Http\Requests;

use Asterisk\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class PRMPeopleRequest extends Request
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
        $output = [];

        switch ($this->method()){
            case 'POST' :
            case 'GET' :
                $output = [
                    'first_name' => 'required',
                    'mobile'    =>  'required',
                    'email' => 'email'
                ];
                break;
            case 'PATCH' :
                if($this->hasFile('photo')){
                    //This condition only for upload display picture
                    $output = [
                        'photo' => 'required'
                    ];
                }else{
                    $output = [
                        'first_name' => 'required',
                        'mobile'    =>  'required',
                        'email' => 'email'
                    ];
                }
        }
        return $output;
    }
}
