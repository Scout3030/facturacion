<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
                    'category_id' => [
                        'required',
                        Rule::exists('categories', 'id')
                    ],
                    'code' => 'required|unique:products,code|size:8',
                    'name' => 'required|min:5',
                    'cost' => 'required|min:0',
                    'price' => 'required|min:0',
                    'stock' => 'required|integer|min:1',
                ];
            }
            case 'PUT': {
                /** code */
                return [
                    'category_id' => [
                        'required',
                        Rule::exists('categories', 'id')
                    ],
                    'name' => 'required|min:5',
                    'cost' => 'required|min:0',
                    'price' => 'required|min:0',
                    'stock' => 'required|integer|min:1',
                ];
            }
        }
    }
}
