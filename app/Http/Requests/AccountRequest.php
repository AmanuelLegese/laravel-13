<?php

namespace App\Http\Requests;

use App\Enums\PlatformEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
			'platform' => ['required',Rule::in(PlatformEnums::values())],
			'platform_account_id' => 'required|string',
			'account_name' => 'required|string',
			'access_token_encrypted' => 'required|string',
			'is_active' => 'required',
			'remark' => 'string',
        ];
    }
}
