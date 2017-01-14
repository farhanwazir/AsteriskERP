<?php

namespace Asterisk\Http\Requests;

use Asterisk\Http\Requests\Request;
use Asterisk\Modules\PRM\Models\Peoples\Contacts;

class PRMContactRequest extends Request
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
        $rule = [];
        /*switch($this->input('_method')){
            case 'PATCH':
                $rule = [
                    'title' => 'required|min:3|unique:'.with(new Contacts)->getTable().',title,NULL,NULL,people_id,'.$this->input('people'),
                    'country_code' => 'required'
                ];
                break;
            default:
                $rule = [
                    'title' => 'required|min:3|unique:'.with(new Contacts)->getTable().',title,NULL,NULL,people_id,'.$this->input('people'),
                    'country_code' => 'required'
                ];
                break;

        }*/

        //Unique:table name, duplication column, except value, except column, match column, match value

        $rule = [
            'title' => 'required|min:3|unique:'.with(new Contacts)->getTable().',title,'.$this->input('contact').',id,people_id,'.$this->input('people'),
            'country_code' => 'required'
        ];

        return $rule;
    }
}
