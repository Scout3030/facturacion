<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST': {
                return [
                    'client_id' => [
                        'required',
                        Rule::exists('clients', 'id')
                    ],
                    'cart' => 'required',
                ];
            }
            case 'PUT': {
                /** code */
                return [
                    'client_id' => [
                        'required',
                        Rule::exists('clients', 'id')
                    ],
                    'cart' => 'required',
                ];
            }
        }
    }
}
