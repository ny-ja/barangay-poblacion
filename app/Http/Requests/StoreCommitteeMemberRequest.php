<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommitteeMemberRequest extends FormRequest
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
            'committee_id' => 'required|exists:committees,id',
            'full_name' => 'required|string|max:100',
            'position' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'contact_number' => 'required|string|max:25',
            'email' => 'required|string|email|max:255|unique:committee_members',
            'role' => 'nullable|string',
            'profile' => 'nullable|string',
            'address' => 'required|string',
            'member_photo_path' => 'nullable|image',
        ];
    }
}
