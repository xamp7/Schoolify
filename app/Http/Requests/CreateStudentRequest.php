<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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

              'name' => 'required',
              'fatherName' => 'required' ,
              'secId' => 'required|int' ,
              'email' => 'required|email',
              'password' => 'required' ,
              'phone' => 'required' ,
              'address' => 'required',
              'joined' => 'required|date'

        ];
    }
}
