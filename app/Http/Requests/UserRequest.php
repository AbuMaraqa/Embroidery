<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'user_role' => 'required',
            'phone' => 'required|regex:/^\d{10}$/',
        ];

        // تحقق من نوع الطلب
        if ($this->isMethod('post')) {
            // قواعد إضافة مستخدم جديد
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|min:8';
        } elseif ($this->isMethod('put')) {
            // قواعد تعديل مستخدم موجود
            $rules['email'] = 'required|email|unique:users,email,' . $this->id;
            $rules['password'] = 'nullable|min:8';
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'الايميل مطلوب',
            'email.email' => 'يجب ان يكون الايميل صحيح',
            'email.unique' => 'الايميل موجود مسبقا',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب ان تكون اكثر من 8 احرف',
            'user_role.required' => 'نوع المستخدم مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.regex' => 'يجب ان يكون رقم الهاتف صحيح',
            'dob' => 'تاريخ الميلاد مطلوب'
        ];
    }
}
