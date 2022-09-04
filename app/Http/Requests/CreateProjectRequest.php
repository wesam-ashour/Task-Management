<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
            'title_en' => ['required','max:255'],
            'title_ar' => ['required','max:255'],
            'description_en' => ['required','max:255'],
            'description_ar' => ['required','max:255'],
            'deadline' => ['required', 'date'],
            'user_id' => ['required', 'exists:users,id'],
            'client_id' => ['required', 'exists:clients,id'],
            'status' => ['required','max:255'],
        ];
    }
}
