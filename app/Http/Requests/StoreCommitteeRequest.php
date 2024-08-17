<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommitteeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'committee_profile' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'contact_number' => 'required|string|max:25',
            'committee_profile_photo_path' => 'nullable|image',
        ];
    }
}
