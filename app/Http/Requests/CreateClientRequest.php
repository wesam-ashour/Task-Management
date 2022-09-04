<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_en' => ['required','max:255'],
            'company_ar' => ['required','max:255'],
            'vat_en' => ['required','max:255'],
            'vat_ar' => ['required','max:255'],
            'address_en' => ['required','max:255'],
            'address_ar' => ['required','max:255'],
        ];
    }
}
