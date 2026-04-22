<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
			'platform' => 'required',
			'platform_account_id' => 'required|string',
			'account_name' => 'required|string',
			'access_token_encrypted' => 'required|string',
			'is_active' => 'required',
			'remark' => 'string',
        ];
    }
}
