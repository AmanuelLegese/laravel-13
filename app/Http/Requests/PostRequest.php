<?php

namespace App\Http\Requests;

use App\Enums\PostStatusEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
			'text' => 'required|string',
			'post_status' => ['required',Rule::in(PostStatusEnums::values())],
            'scheduled_at' => 'required',
            'published_at' => 'required',
			'remark' => 'required|string',
        ];
    }
}
