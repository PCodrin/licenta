<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAddItemToCart extends FormRequest
{
    protected $rules = [];
    protected $messages = [];

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
        return $this->rules;
    }

    public function messages()
    {
        return $this->messages;
    }

    protected function prepareForValidation()
    {

        $params = parent::except('_token');

        foreach ($params as $index => $param) {
            $this->rules[$index . '.quantity'] = 'required|integer|max:5|min:1';
            $this->rules[$index . '.product_id'] = 'required|integer|exists:products,id';
            $this->messages[$index . '.quantity.required'] = 'The field is required';
            $this->messages[$index . '.quantity.integer'] = 'The field must be a number';
            $this->messages[$index . '.quantity.max:5'] = 'Value must be greater than or equal to 1';
            $this->messages[$index . '.quantity.min:1'] = 'Value must be less than or equal to 5';
            $this->messages[$index . '.product_id.required'] = 'Something went wrong. Please try again!';
            $this->messages[$index . '.product_id.integer'] = 'Something went wrong. Please try again!';
            $this->messages[$index . '.product_id.exists'] = 'Something went wrong. Please try again!';

        }


    }


}
