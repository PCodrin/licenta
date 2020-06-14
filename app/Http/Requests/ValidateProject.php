<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProject extends FormRequest
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
        $params = parent::except('_token','_method');
        foreach ($params as $index => $param) {
            $this->rules[$index.'.name'] = 'required|string';
            $this->rules[$index.'.description'] = 'required|string';
            $this->rules[$index.'.price'] = 'required|integer|min:0';
            $this->rules[$index.'.in_stock'] = 'required|integer|min:0';
            $this->messages[$index . '.name.required'] = 'The field is required';
            $this->messages[$index . '.name.string'] = 'The field must be a number';
            $this->messages[$index . '.description.required'] = 'The field is required';
            $this->messages[$index . '.description.string'] = 'The field must be a number';
            $this->messages[$index . '.price.required'] = 'The field is required';
            $this->messages[$index . '.price.integer'] = 'The field must be a number';
            $this->messages[$index . '.price.min:0'] = 'Value must be greater than or equal to 0';;
            $this->messages[$index . '.in_stock.required'] = 'The field is required';
            $this->messages[$index . '.in_stock.integer'] = 'The field must be a number';
            $this->messages[$index . '.in_stock.min:0'] = 'Value must be greater than or equal to 0';;
        }
    }
}
