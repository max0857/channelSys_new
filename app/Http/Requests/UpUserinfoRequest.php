<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpUserinfoRequest extends Request
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
            'name'=>'required|max:30',
            'phone'=>'required|min:11|max:11',
            'email'=>'required|email|max:50',
            'bankname'=>'required|max:50',
            'accountname'=>'required|max:50',
            'accountcode'=>'required|max:50',
            'bankaddress'=>'required|max:50'
        ];
    }
}
