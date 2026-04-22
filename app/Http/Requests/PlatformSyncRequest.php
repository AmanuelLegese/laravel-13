<?php

namespace App\Http\Requests;

use App\Enums\SyncStatusEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlatformSyncRequest extends FormRequest
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
			'post_id' => 'required|exists:posts,id',
			'account_id' => 'required|exists:accounts,id',
			'external_post_id' => 'required',
			'sync_status' => ['required', Rule::in(SyncStatusEnums::values())],
			'last_error' => 'string',
			'remark' => 'string',
        ];
    }
}
