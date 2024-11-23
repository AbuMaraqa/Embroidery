<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'category_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        // تحقق من نوع الطلب
        if ($this->isMethod('post')) {
            $rules['product_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } elseif ($this->isMethod('put')) {
            $rules['product_image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'product_name.required' => 'يرجى ادخال اسم المنتج',
            'product_price.required' => 'يرجى ادخال سعر المنتج',
            'product_price.numeric' => 'يرجى ادخال سعر صحيح',
            'category_id.required' => 'يرجى ادخال التصنيف',
            'product_image.required' => 'يرجى ادخال صورة المنتج',
            'product_image.image' => 'يرجى ادخال صورة صحيحة',
            'product_image.mimes' => 'يرجى ادخال صورة بصيغة jpeg,png,jpg,gif,svg',
            'product_image.max' => 'يرجى ادخال صورة بحجم لا يزيد عن 2MB',
        ];
    }
}
