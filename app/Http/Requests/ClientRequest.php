<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                    'title' => 'required|min:5',
                    'document_number' => 'required|min:8',
                ];
            }
            case 'PUT': {
                /** code */
                return [
                    'title' => 'required|min:5',
                    'document_number' => 'required|min:8',
                ];
            }
        }
    }
}
