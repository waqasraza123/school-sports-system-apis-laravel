<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RostersUploadRequest extends Request
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
            'first_name' => 'required|min:3',
            'jersey' => 'required',
            'position' => 'required',
            'heightfeet' => 'required',
            'heightinches' => 'required',
            'weight' => 'required',
            'hometown' => 'required',
            'bible' => 'required',
            'food' => 'required',
            'sfc' => 'required',
            'invisible_id' => '',
            'image' => '',
        ];
    }
}
