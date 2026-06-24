<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','min:2','max:120'],
            'email' => ['required','email','max:190'],
            'subject' => ['required','string','min:3','max:150'],
            'message' => ['required','string','min:10','max:5000'],

            // Honeypot anti-spam (ne doit pas être rempli)
            'hp_website' => ['nullable','string','max:1','prohibited_if:hp_website,filled'],


        ];
    }

}
