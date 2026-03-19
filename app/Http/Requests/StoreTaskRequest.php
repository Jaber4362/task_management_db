<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
    /**
     * قواعد التحقق من صحة البيانات.
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|min:1|max:5'
        ];
    }

    /**
     * رسائل الخطأ المخصصة باللغة العربية.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'حقل العنوان مطلوب',
            'title.string' => 'حقل العنوان يجب أن يكون نصاً',
            'title.max' => 'الحد الأقصى لعدد أحرف العنوان هو 40 حرفاً',

            'description.string' => 'حقل الوصف يجب أن يكون نصاً',

            'priority.required' => 'حقل الأولوية مطلوب',
            'priority.integer' => 'حقل الأولوية يجب أن يكون رقماً صحيحاً',
            'priority.min' => 'قيمة الأولوية يجب أن تكون 1 على الأقل',
            'priority.max' => 'قيمة الأولوية يجب أن تكون 5 كحد أقصى'
        ];
    }
}
