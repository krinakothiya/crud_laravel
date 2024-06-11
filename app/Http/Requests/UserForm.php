<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true if authorization is not required
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() == 'PATCH') {

            // This validation is use in edit form.
            $rules['name'] = 'required|string';
            $rules['phone'] = 'required|numeric|digits:10';
            $rules['age'] = 'required|numeric|digits:2';
            $rules['address'] = 'required|string';
            $rules['gender'] = 'required|in:male,female,other';
            $rules['hobby'] = 'required|array|min:1';
            $rules['hobby.*'] = 'in:sports,reading,music,traveling';
            $rules['city'] = 'required|string';
            $rules['img'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';       // Max file size of 2MB, adjust as needed


        } else {
            // This validation is use in cerate form.
            $rules['name'] = 'required|string';
            $rules['phone'] = 'required|numeric|digits:10';
            $rules['age'] = 'required|numeric|digits:2';
            $rules['address'] = 'required|string';
            $rules['gender'] = 'required|in:male,female,other';
            $rules['hobby'] = 'required|array|min:1';
            $rules['hobby.*'] = 'in:sports,reading,music,traveling';
            $rules['city'] = 'required|string|max:255';
            $rules['img'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';       // Max file size of 2MB, adjust as needed
            $rules['checkbox'] = 'accepted';

            // $rules['collage'] = 'required|string';
            // $rules['year'] = 'required|numeric|digits:4';
            // $rules['Percentage'] = 'required|numeric|between:0,100';
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter your name.',
            'phone.required' => 'Please enter your phone number.',
            'phone.numeric' => 'Phone number should be numeric.',
            'phone.digits' => 'Phone number should be 10 digits.',
            'age.required' => 'Please enter your age.',
            'age.numeric' => 'Age should be numeric.',
            'age.digits' => 'Age should be 2 digits.',
            'address.required' => 'Please enter your address.',
            'gender.required' => 'Please select your gender.',
            'hobby.required' => 'Please select at least one hobby.',
            'hobby.*.in' => 'Invalid hobby selected.',
            'city.required' => 'Please select your city.',
            // 'img.required' => 'Please upload an image.',
            'img.image' => 'The file must be an image.',
            'img.mimes' => 'The image must be of type: jpeg, png, jpg, gif, svg.',
            'img.max' => 'Image size must not exceed 2MB.',
            'checkbox.accepted' => 'Please agree to the terms and conditions.',

        ];
    }
}
