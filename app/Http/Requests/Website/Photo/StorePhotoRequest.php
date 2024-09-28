<?php

namespace App\Http\Requests\Website\Photo;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'reminder_time' => ['nullable', 'date', 'after_or_equal:today'],
            'category_id' => ['nullable', 'exists:categories,id'],

        ];
    }
    protected function prepareForValidation()
    {
        if ($this->due_date) {
            // Convert due_date to Y-m-d format if it's not null
            $this->merge([
                'due_date' => \Carbon\Carbon::createFromFormat('m/d/Y', $this->due_date)->format('Y-m-d')
            ]);
        }

    }


}
